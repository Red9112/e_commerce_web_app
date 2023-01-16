<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;



class generalTest extends TestCase
{
   use RefreshDatabase;
    public function test_example()
    {
        $response = $this->get('/');
        
        $response->assertStatus(200);

    }

    public function test_save_category()
    {
        $cat=new Category();
        $cat->name="informatiq";
        $cat->save();

        $response = $this->assertDatabaseHas('categories',[
            'name'=>'informatiq'
        ]);
      
    }
    public function test_store_category()
    {

        $data=['name'=>'azer'];
        $this->post('/category',$data)
        ->assertStatus(302)
        ->assertSessionHas('status');

        $this->assertEquals(session('status'),'a category was created !! ');
    }

    public function test_store_category_failure(){
        $data=['name'=>''];
        $this->post('/category',$data)
        ->assertStatus(302)
        ->assertSessionHas('errors');
        $messages=session('errors')->getMessages();
$this->assertEquals( $messages['name'][0],'The name must be at least 3 characters.');

    }

    public function test_update_category(){
        $cat=new Category();
        $cat->name="nmcat";
        $cat->save();
        $this->assertDatabaseHas('categories',$cat->toArray());

$data=['name'=>'updated name'];
$this->put("/category/{$cat->id}",$data)
->assertStatus(302)
->assertSessionHas('status');
$this->assertEquals(session('status'),'The Category was updated !!');
$this->assertDatabaseMissing('categories',['name'=>'nmcat']);
    }
    public function test_delete_category(){
        $cat=new Category();
        $cat->name="nmcat";
        $cat->save();
    $this->assertDatabaseHas('categories',$cat->toArray());

    $this->delete("/category/{$cat->id}")
    ->assertStatus(302)
    ->assertSessionHas('failed');
    $this->assertDatabaseMissing('categories',$cat->toArray());
    }


}
