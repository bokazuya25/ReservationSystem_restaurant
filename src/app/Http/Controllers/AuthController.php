<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Review;
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
        $reservations = $this->getReservationsByStatus('予約');
        $histories = $this->getReservationsByStatus('来店');

        $favorites = Auth::user()->favorites()
            ->pluck('shop_id')
            ->toArray();

        $shops = Shop::with(['area', 'genre'])
            ->whereIn('id', $favorites)
            ->get();


        $user = Auth::user();
        $viewData = [
            'user' =>$user,
            'reservations' => $reservations,
            'histories' => $histories,
            'favorites' => $favorites,
            'shops' => $shops
        ];

        if ($user->hasRole('admin')) {
            $viewData['roleView'] = 'mypage.partials.admin';
        }elseif ($user->hasRole('writer')) {
            $viewData['roleView'] = 'mypage.partials.writer';
        }else {
            $viewData['roleView'] = 'mypage.partials.user';
        }

        return view('mypage.dashboard', $viewData);
    }

    private function getReservationsByStatus($status){
        return Auth::user()->reservations()
            ->where('status', $status)
            ->with(['shop','review'])
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();
    }
}
