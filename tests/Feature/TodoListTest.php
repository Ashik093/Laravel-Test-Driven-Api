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
    public function test_while_todo_list_is_storing_name_field_is_required()
    {
        $this->withExceptionHandling();
        $response = $this->postJson(route('todo.list.store'))
                    ->assertUnprocessable()
                    ->assertJsonValidationErrors(['name']);
    }
    public function test_delete_todo_list()
    {
        $this->deleteJson(route('todo.list.destroy',$this->list[3]))
                ->assertNoContent();
        $this->assertDatabaseMissing('todo_lists',['name'=>$this->list[3]->name]);
    }
    public function test_update_todo_list()
    {
        $this->patchJson(route('todo.list.update',$this->list[3]),['name'=>'update name'])
            ->assertOk();
        $this->assertDatabaseHas('todo_lists',['id'=>$this->list[3]->id,'name'=>'update name']);
        
    }
    public function test_while_todo_list_is_updating_name_field_is_required()
    {
        $this->withExceptionHandling();
        $response = $this->patchJson(route('todo.list.update',$this->list[3]))
                    ->assertUnprocessable()
                    ->assertJsonValidationErrors(['name']);
    }
}