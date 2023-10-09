@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
    <p class="user__name">{{ Auth::user()->name }}さん</p>
    <div class="mypage__wrap">
        <div class="reservation__wrap">
            <p class="reservation__title">予約状況</p>
            {{-- @foreach ($reservations as $reservation) --}}
                <div class="reservation__content">
                    <div class="reservation__header">
                        <p class="header__title">予約1</p>
                        <form action="" class="header__form">
                            <button type="submit" class="form__button">
                                <img src="{{ asset('images/batsu.svg') }}" alt="予約キャンセル" class="form__button-img">
                            </button>
                        </form>
                    </div>
                    <table class="reservation__table">
                        <tr>
                            <th class="table__header">Shop</th>
                            <td class="table__item">仙人</td>
                        </tr>
                        <tr>
                            <th class="table__header">Date</th>
                            <td class="table__item">2021-04-01</td>
                        </tr>
                        <tr>
                            <th class="table__header">Time</th>
                            <td class="table__item">17:00</td>
                        </tr>
                        <tr>
                            <th class="table__header">Number</th>
                            <td class="table__item">1人</td>
                        </tr>
                    </table>
                </div>
            {{-- @endforeach --}}
        </div>

        <div class="favorite__wrap">
            <p class="favorite__title">お気に入り店舗</p>
            <div class="shop__wrap">
                @foreach ($shops as $shop)
                    <div class="shop__content">
                        <img class="shop__image" src="{{ $shop->image_url }}" alt="イメージ画像">
                        <div class="shop__item">
                            <span class="shop__title">{{ $shop->name }}</span>
                            <div class="shop__tag">
                                <p class="shop__tag-info">#{{ $shop->area->area }}</p>
                                <p class="shop__tag-info">#{{ $shop->genre->genre }}</p>
                            </div>
                            <div class="shop__button">
                                <a href="/detail/{{ $shop->id }}?from=mypage" class="shop__button-detail">詳しくみる</a>
                                @if(in_array($shop->id,$favorites))
                                    <form action="{{ route('unfavorite',$shop) }}" method="post" class="shop__button-favorite">
                                        @csrf
                                        @method('delete')
                                            <button type="submit" class="shop__button-favorite-btn--red"></button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection