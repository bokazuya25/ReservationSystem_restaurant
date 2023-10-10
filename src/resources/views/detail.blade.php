@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
    <div class="detail__wrap">
        <div class="detail__header">
            <a href="{{ $backRoute }}" class="header__back">
                <
            </a>
            <span class="header__shop-name">{{ $shop->name }}</span>
        </div>
        <div class="detail__image">
            <img src="{{ $shop->image_url }}" alt="イメージ画像" class="detail__image-img">
        </div>
        <div class="detail__tag">
            <p class="detail__tag-info">#{{ $shop->area->area }}</p>
            <p class="detail__tag-info">#{{ $shop->genre->genre }}</p>
        </div>
        <div class="detail__outline">
            <p class="detail__outline-text">{{ $shop->outline }}</p>
        </div>
    </div>

    <form action="{{ route('reservation',$shop) }}" method="post" class="reservation__wrap">
        @csrf
        <div class="reservation__content">
            <p class="reservation__title">予約</p>
            <div class="form__content">
                <input type="date" class="form__item" name="date">
                <select name="time" class="form__item" required>
                    <option value="" selected disabled>-- 時間を選択してください --</option>
                    <option value="20:00">20:00</option>
                    <option value="20:30">20:30</option>
                    <option value="21:00">21:00</option>
                    <option value="21:30">21:30</option>
                    <option value="22:00">22:00</option>
                </select>
                <select name="number" class="form__item" required>
                    <option value="" selected disabled>-- 人数を選択してください --</option>
                    <option value="1">1人</option>
                    <option value="2">2人</option>
                    <option value="3">3人</option>
                    <option value="4">4人</option>
                    <option value="5">5人</option>
                </select>
            </div>

            <div class="reservation__group">
                <div class="reservation__area">
                    <table class="reservation__table">
                        <tr>
                            <th class="table__header">Shop</th>
                            <td class="table__item">{{ $shop->name }}</td>
                        </tr>
                        <tr>
                            <th class="table__header">Date</th>
                            <td class="table__item" id="dateId"></td>
                        </tr>
                        <tr>
                            <th class="table__header">Time</th>
                            <td class="table__item" id="timeId"></td>
                        </tr>
                        <tr>
                            <th class="table__header">Number</th>
                            <td class="table__item" id="numberId"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="reservation__button">
            <button type="submit" class="reservation__button-btn">予約する</button>
        </div>
    </form>
    <script src="{{ asset('js/detail.js') }}"></script>
@endsection
