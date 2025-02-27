<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return response()->json("SUCCESS");
    }

    public function store(Request $request)
    {
        return response()->json("SUCCESS");
    }

    public function show($id)
    {
        return response()->json("SUCCESS");
    }

    public function update(Request $request, $id)
    {
        return response()->json("SUCCESS");
    }

    public function destroy($id)
    {
        return response()->json("SUCCESS");
    }
}
