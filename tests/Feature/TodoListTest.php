<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\TodoList;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;
    private $list;

    public function setUp():void{
        parent::setUp();
        $this->list = TodoList::factory()->count(10)->create();
    }
 
    public function test_fetch_all_todo_list()
    {
    
        $response = $this->getJson(route('todo.list.index'));

        $this->assertEquals(10,count($response->json()));
        
    }
    public function test_fetch_single_todo_list()
    {
        
        $response = $this->getJson(route('todo.list.show',4))->assertOk()->json();

        $this->assertEquals($response['id'],4);
    }
    public function test_store_todo_list()
    {
        $list = TodoList::factory()->make();
        $response = $this->postJson(route('todo.list.store'),['name'=>$list->name])
                        ->assertCreated()->json();

        $this->assertEquals($list->name,$response['name']);
        $this->assertDatabaseHas('todo_lists',['name'=>$list->name]);
    }
}