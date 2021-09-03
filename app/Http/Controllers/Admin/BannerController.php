<?php

namespace App\Http\Controllers\Admin;

use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Banner;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    function list() {
        $banners = Banner::orderBy('id', 'desc')->paginate(25);
        return view('admin-views.banner.view', compact('banners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required',
            'image' => 'required',
        ], [
            'url.required' => 'url is required!',
            'image.required' => 'Image is required!',

        ]);

        $banner = new Banner;
        $banner->banner_type = $request->banner_type;
        $banner->url = $request->url;
        $banner->photo = ImageManager::upload('banner/', 'png', $request->file('image'));
        $banner->save();
        Toastr::success('Banner added successfully!');
        return back();
    }

    public function status(Request $request)
    {
        if ($request->ajax()) {
            $banner = Banner::find($request->id);
            $banner->published = $request->status;
            $banner->save();
            $data = $request->status;
            return response()->json($data);
        }
    }

    public function edit(Request $request)
    {
        $data = Banner::where('id', $request->id)->first();
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'url' => 'required',
        ], [
            'url.required' => 'url is required!',
        ]);
        $banner = Banner::find($request->id);
        $banner->banner_type = $request->banner_type;
        $banner->url = $request->url;
        if($request->file('image'))
        {
            $banner->photo = ImageManager::update('banner/', $banner['photo'], 'png', $request->file('image'));
        }

        $banner->save();

        // return response()->json();
        Toastr::success('Banner updated successfully!');
        return back();
    }

    public function delete(Request $request)
    {
        $br = Banner::find($request->id);
        ImageManager::delete('/banner/' . $br['photo']);
        $br->delete();
        return response()->json();
    }
}
