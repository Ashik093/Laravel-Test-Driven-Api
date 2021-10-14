<?php

namespace App\Http\Controllers\Api;

use App\Models\TodoList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoListController extends Controller
{
    public function index()
    {
        $list = TodoList::get();
        return response($list);
    }
    public function show(TodoList $todoList)
    {
        return response($todoList);
    }
    public function store(Request $request)
    {
        $list = TodoList::create($request->all());
        return $list;
    }
}
