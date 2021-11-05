<?php

namespace App\Http\Controllers\Api;

use App\Models\TodoList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TodoListRequest;
use Symfony\Component\HttpFoundation\Response;

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
    public function store(TodoListRequest $request)
    {
        $list = TodoList::create($request->all());
        return $list;
    }
    public function destroy(TodoList $list)
    {
        $list->delete();
        return response('',Response::HTTP_NO_CONTENT);
    }
    public function update(TodoListRequest $request,TodoList $list)
    {
        $list->update(['name'=>$request->name]);
        return $list;
    }
}
