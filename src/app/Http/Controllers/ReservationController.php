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
}
