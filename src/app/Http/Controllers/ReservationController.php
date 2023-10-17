<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Shop $shop,Request $request)
    {
        $reservation = new Reservation();
        $reservation->shop_id = $shop->id;
        $reservation->user_id = Auth::user()->id;
        $reservation->date = $request->input('date');
        $reservation->time = $request->input('time');
        $reservation->number = $request->input('number');
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
        $backRoute = '/mypage';
        return view('detail',compact('reservation','shop','backRoute'));
    }

    public function update(Request $request,Reservation $reservation){
        $edit = $request->all();
        Reservation::find($reservation->id)->update($edit);
        return redirect('/done');
    }
}
