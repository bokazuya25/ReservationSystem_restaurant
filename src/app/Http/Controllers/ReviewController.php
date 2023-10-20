<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Reservation $reservation)
    {
        $shop = Shop::find($reservation->shop_id);

        return view('review', compact('reservation', 'shop'));
    }

    public function store(Request $request, Reservation $reservation)
    {
        $review = Review::where('reservation_id',$reservation->id)->first();

        if ($review) {
            $review->rating = $request->input('rating');
            $review->comment = $request->input('comment');
        }else {
            $review = new Review();
            $review->reservation_id = $reservation->id;
            $review->rating = $request->input('rating');
            $review->comment = $request->input('comment');
        }
        $review->save();

        return view('thanks_review');
    }
}
