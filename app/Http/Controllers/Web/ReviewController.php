<?php

namespace App\Http\Controllers\Web;

use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Review;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $image_array = [];
        if (!empty($request->file('fileUpload')))
        {
            foreach ($request->file('fileUpload') as $image) {
                if ($image != null) {
                    if (!Storage::disk('public')->exists('review')) {
                        Storage::disk('public')->makeDirectory('review');
                    }
                    array_push($image_array, Storage::disk('public')->put('review', $image));
                }
            }
        }

        if (auth('customer')->check()) {
            $review = new Review;
            $review->customer_id = auth('customer')->id();
            $review->product_id = $request->product_id;
            $review->comment = $request->comment;
            $review->rating = $request->rating;
            $review->attachment = json_encode($image_array);
            $review->save();
            Toastr::success('Your review added successfully!');
            return redirect()->back();
        } else {
            Toastr::error('Login first!');
            return redirect()->back();
        }
    }
}
