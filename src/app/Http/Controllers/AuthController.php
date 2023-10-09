<?php

namespace App\Http\Controllers;

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
        $favorites = [];
        $favorites = Auth::user()->favorites->pluck('shop_id')->toArray();

        $shops = Shop::with(['area','genre'])->whereIn('id',$favorites)->get();

        return view('mypage', compact('shops', 'favorites'));
    }
}
