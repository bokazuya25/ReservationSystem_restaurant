<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function index()
    {
        $reservations = Auth::user()->reservations()->with('shop')->orderBy('date','asc')->orderBy('time','asc')->get();

        $favorites = Auth::user()->favorites()->pluck('shop_id')->toArray();
        $shops = Shop::with(['area','genre'])->whereIn('id',$favorites)->get();

        return view('mypage', compact('reservations','shops', 'favorites'));
    }
}
