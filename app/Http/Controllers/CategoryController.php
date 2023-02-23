<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CategoriesImport;
use function PHPUnit\Framework\isEmpty;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=auth()->user();
        $this->authorize('viewAny',$user);
        return view('Category.category');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function import(Request $request)
    {
     //  dd($request->all());
     Excel::import(new CategoriesImport,$request->file('categories'));
     $request->session()->flash('status','categories are imported via excel file !! ');
        return redirect()->route('category.index');
    }


    public function store(Request $request)
    {
        $user=auth()->user();
        $this->authorize('store',$user);
        $request->validate(['name'=>'min:3']);
        $cat=new Category();
       $cat->name=$request->input('name');
       $cat->parent_id=$request->input('parent_id');
       $cat->save();


   $request->session()->flash('status','a category was created !! ');
       return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=auth()->user();
        $this->authorize('edit',$user);
        $parent=Category::all();
        $category=Category::findOrFail($id);
        return view('Category.edit',[
            'category'=>$category,
            'parent'=>$parent,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=auth()->user();
        $this->authorize('update',$user);
        $request->validate(['name'=>'min:3']);
        $category=Category::findOrFail($id);
        $category->name=$request->input('name');
        $category->parent_id=$request->input('parent_id');
        $category->save();
        $request->session()->flash('status','The Category was updated !!');

      return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $user=auth()->user();
        $this->authorize('delete',$user);
        Category::destroy($id);
        $request->session()->flash('failed',' Category Deleted !!');
        return redirect()->route('category.index');
    }
}
