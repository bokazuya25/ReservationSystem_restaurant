<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index() {
        $shops = Shop::with(['area','genre'])->get();
        return view('index',compact('shops'));
    }

    public function detail(Request $request) {
        $shop = Shop::find($request->shop_id);
        return view('detail',compact('shop'));
    }
}
