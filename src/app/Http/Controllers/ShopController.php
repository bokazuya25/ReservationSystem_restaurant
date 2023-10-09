<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index() {
        $shops = Shop::with(['area','genre'])->get();

        $favorites=[];
        if(Auth::check()) {
            $favorites = Auth::user()->favorites->pluck('shop_id')->toArray();
        }
        return view('index',compact('shops','favorites'));
    }

    public function detail(Request $request) {
        $shop = Shop::find($request->shop_id);
        $from = $request->input('from');

        $backRoute = '/';
        switch ($from) {
            case 'index':
                $backRoute = '/';
                break;
            case 'mypage':
                $backRoute = '/mypage';
                break;
        }
        return view('detail',compact('shop','backRoute'));
    }
}
