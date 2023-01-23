<?php

namespace App\Http\ViewComposers;

use App\Models\Category;
use Illuminate\View\View;


class CategoryComposer{



    public function compose(View $view){

        $categories=Category::with(['products','parent'])->get();
        $view->with([
            'categories'=>$categories,
         ]);
}

}
