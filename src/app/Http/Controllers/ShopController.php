<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Favorite;
use App\Models\Genre;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $shops = $this->searchShops($request);
        $areas = Area::all();
        $genres = Genre::all();
        $favorites = $this->getFavorites();

        return view('index', compact('shops', 'areas', 'genres', 'favorites'));
    }

    public function search(Request $request)
    {
        $shops = $this->searchShops($request);
        $favorites = $this->getFavorites();
        $isLoggedIn = Auth::check();

        return response()->json([
            'shops' => $shops,
            'isLoggedIn' => $isLoggedIn,
            'favorites' => $favorites,
        ]);
    }

    private function searchShops(Request $request): \Illuminate\Support\Collection
    {
        $area = $request->input('area');
        $genre = $request->input('genre');
        $word = $request->input('word');

        return Shop::with(['area', 'genre'])
            ->when($area, function ($query) use ($area) {
                return $query->where('area_id', $area);
            })
            ->when($genre, function ($query) use ($genre) {
                return $query->where('genre_id', $genre);
            })
            ->when($word, function ($query) use ($word) {
                return $query->where('name', 'like', '%' . $word . '%');
            })
            ->get();
    }

    private function getFavorites(): array
    {
        if (Auth::check()) {
            return Auth::user()->favorites()->pluck('shop_id')->toArray();
        }
        return [];
    }

    public function detail(Request $request)
    {
        $shop = Shop::find($request->shop_id);
        $from = $request->input('from');

        $shopRatingIds = Reservation::where('shop_id',$request->shop_id)->pluck('id');
        $avgRating = round(Review::whereIn('reservation_id',$shopRatingIds)->avg('rating'),1);
        $countComments = Review::whereIn('reservation_id',$shopRatingIds)
            ->whereNotNull('comment')
            ->count();
        $countFavorites = Favorite ::where('shop_id',$request->shop_id)->count();

        $backRoute = '/';
        switch ($from) {
            case 'index':
                $backRoute = '/';
                break;
            case 'mypage':
                $backRoute = '/mypage';
                break;
        }
        return view('detail', compact('shop', 'avgRating' ,'countComments','countFavorites','backRoute'));
    }
}
