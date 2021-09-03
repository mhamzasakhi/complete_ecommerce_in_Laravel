<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::latest()->paginate(25);
        return view('admin-views.attribute.view',compact('attributes'));
    }

    public function store(Request $request)
    {
        $attribute = new Attribute;
        $attribute->name = $request->name;
        $attribute->save();
        return response()->json();
    }

    public function edit(Request $request)
    {
        $data = Attribute::where('id', $request->id)->first();
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $attribute = Attribute::find($request->id);
        $attribute->name = $request->name;
        $attribute->save();
        return response()->json();
    }

    public function delete(Request $request)
    {
        Attribute::destroy($request->id);
        return response()->json();
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $data = Attribute::orderBy('id', 'desc')->get();
            return response()->json($data);
        }
    }
}
