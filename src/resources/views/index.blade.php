@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header')
    <div action="/search" method="get" class="header__right">
        <label class="select-box__label">
            <select name="area" class="select-box__item">
                <option value="">All area</option>
                @foreach ($areas as $area)
                    <option class="select-box__option" value="{{ $area->id }}"
                        {{ request('area') == $area->id ? 'selected' : '' }}>{{ $area->name }}
                    </option>
                @endforeach
            </select>
        </label>

        <label class="select-box__label">
            <select name="genre" class="select-box__item">
                <option value="">All genre</option>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : ''}}>{{ $genre->name }}</option>
                @endforeach
            </select>
        </label>

        <div class="search__item">
            <div class="search__item-button"></div>
            <label class="search__item-label">
                <input type="text" name="word" class="search__item-input" placeholder="Search ..." value="{{ request('word') }}">
            </label>
        </div>
    </div>
@endsection

@section('content')
    <div class="shop__wrap">
        @foreach ($shops as $shop)
            <div class="shop__content">
                <img class="shop__image" src="{{ $shop->image_url }}" alt="イメージ画像">
                <div class="shop__item">
                    <span class="shop__title">{{ $shop->name }}</span>
                    <div class="shop__tag">
                        <p class="shop__tag-info">#{{ $shop->area->name }}</p>
                        <p class="shop__tag-info">#{{ $shop->genre->name }}</p>
                    </div>
                    <div class="shop__button">
                        <a href="/detail/{{ $shop->id }}?from=index" class="shop__button-detail">詳しくみる</a>
                        @if (Auth::check())
                            @if (in_array($shop->id, $favorites))
                                <form action="{{ route('unfavorite', $shop) }}" method="post" class="shop__button-favorite">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="position" value="0">
                                    <button type="submit" class="shop__button-favorite-btn" title="お気に入り削除">
                                        <img class="favorite__btn-image" src="{{ asset('images/heart_color.svg') }}">
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('favorite', $shop) }}" method="post" class="shop__button-favorite">
                                    @csrf
                                    <button type="submit" class="shop__button-favorite-btn" title="お気に入り追加">
                                        <img class="favorite__btn-image" src="{{ asset('images/heart.svg') }}">
                                    </button>
                                </form>
                            @endif
                        @else
                            <button type="button" onclick="location.href='/login'" class="shop__button-favorite-btn">
                                <img class="favorite__btn-image" src="{{ asset('images/heart.svg') }}">
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        <div class="shop__content dummy"></div>
        <div class="shop__content dummy"></div>
        <div class="shop__content dummy"></div>
        <div class="shop__content dummy"></div>
    </div>
    <script src="{{ asset('js/search.js') }}"></script>
@endsection
