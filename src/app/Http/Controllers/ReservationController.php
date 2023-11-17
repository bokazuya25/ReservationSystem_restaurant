<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Shop $shop,ReservationRequest $request)
    {
        $reservation = new Reservation();
        $reservation->shop_id = $shop->id;
        $reservation->user_id = Auth::user()->id;
        $reservation->date = $request->input('date');
        $reservation->time = $request->input('time');
        $reservation->number = $request->input('number');
        $reservation->status = "予約";
        $reservation->save();

        return redirect('/done');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return back();
    }

    public function edit(Reservation $reservation){
        $shop = Shop::find($reservation->shop_id);

        $shopRatingIds = Reservation::where('shop_id', $reservation->shop_id)->pluck('id');
        $avgRating = round(Review::whereIn('reservation_id', $shopRatingIds)->avg('rating'), 1);
        $countComments = Review::whereIn('reservation_id', $shopRatingIds)
            ->whereNotNull('comment')
            ->count();
        $countFavorites = Favorite::where('shop_id', $reservation->shop_id)->count();

        $backRoute = '/mypage';

        return view('detail',compact('reservation','shop','avgRating','countComments','countFavorites','backRoute'));
    }

    public function update(ReservationRequest $request,Reservation $reservation){
        $edit = $request->all();
        Reservation::find($reservation->id)->update($edit);
        return redirect('/done');
    }
}
