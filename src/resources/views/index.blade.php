@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header')
    <form class="header__right">
        <label class="select-box__label">
            <select class="select-box__item">
                <option class="select-box__option">All area</option>
                <option class="select-box__option">東京都</option>
                <option class="select-box__option">大阪府</option>
                <option class="select-box__option">福岡県</option>
            </select>
        </label>

        <label class="select-box__label">
            <select class="select-box__item">
                <option>All genre</option>
                <option>寿司</option>
                <option>焼肉</option>
                <option>居酒屋</option>
                <option>イタリアン</option>
                <option>ラーメン</option>
            </select>
        </label>

        <div class="search__item">
            <button type="submit" class="search__item-button" aria-label="検索"></button>
            <label class="search__item-lavel">
                <input type="text" class="search__item-input" placeholder="Search ...">
            </label>
        </div>
    </form>
@endsection

@section('content')
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
                    <a href="/detail/{{ $shop->id }}" class="shop__button-detail">詳しくみる</a>
                    <form action="" class="shop__button-favorite">
                        <button type="submit" class="shop__button-favorite-btn"></button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
