<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Review;

class ReviewsController extends Controller
{
    function list() {
        $reviews = Review::with(['product', 'customer'])->latest()->paginate(10);
        return view('admin-views.reviews.list', compact('reviews'));
    }
}
