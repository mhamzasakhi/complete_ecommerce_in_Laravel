<?php

namespace App\Http\Controllers\Admin;

use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\Brand;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function add_new()
    {
        $br = Brand::latest()->paginate(25);
        return view('admin-views.brand.add-new', compact('br'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Brand name is required!',
        ]);

        DB::table('brands')->insert([
            'name' => $request->name,
            'image' => ImageManager::upload('brand/', 'png', $request->file('image')),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Toastr::success('Brand added successfully!');
        return back();
    }

    function list()
    {
        $br = Brand::latest()->paginate(25);
        return view('admin-views.brand.list', compact('br'));
    }

    public function edit($id)
    {
        $b = Brand::where(['id' => $id])->first();
        return view('admin-views.brand.edit', compact('b'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Brand name is required!',
        ]);

        $brand = Brand::find($id);
        if ($request->has('image')) {
            $image_name = ImageManager::update('brand/', $brand['image'], 'png', $request->file('image'));
        } else {
            $image_name = $brand->image;
        }

        DB::table('brands')->where(['id' => $id])->update([
            'name' => $request->name,
            'image' => $image_name,
            'updated_at' => now(),
        ]);

        Toastr::success('Brand updated successfully!');
        return back();
    }

    public function delete(Request $request)
    {
        $brand = Brand::find($request->id);
        ImageManager::delete('/brand/' . $brand['image']);
        $brand->delete();
        return response()->json();
    }
}
