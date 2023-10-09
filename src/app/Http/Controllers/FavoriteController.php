<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Shop $shop)
    {
        $favorite = new Favorite();
        $favorite->shop_id = $shop->id;
        $favorite->user_id = Auth::user()->id;
        $favorite->save();

        return back();
    }

    public function destroy(Shop $shop)
    {
        $user = Auth::user()->id;
        $favorite = Favorite::where('shop_id', $shop->id)
            ->where('user_id', $user)->first();
        $favorite->delete();

        return back();
    }
}
