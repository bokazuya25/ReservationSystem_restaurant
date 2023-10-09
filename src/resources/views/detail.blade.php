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

    <form class="reservation__wrap">
        <div class="reservation__content">
            <p class="reservation__title">予約</p>
            <div action="" class="form__content">
                <input type="date" class="form__item" name="date">
                <input type="time" class="form__item" name="time">
                <input type="text" class="form__item" name="number">
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
                            <td class="table__item"></td>
                        </tr>
                        <tr>
                            <th class="table__header">Time</th>
                            <td class="table__item"></td>
                        </tr>
                        <tr>
                            <th class="table__header">Number</th>
                            <td class="table__item"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="reservation__button">
            <button type="submit" class="reservation__button-btn">予約する</button>
        </div>
    </form>
@endsection
