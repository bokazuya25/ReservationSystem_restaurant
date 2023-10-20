@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
    <div class="review__wrap">
        <div class="review__header">
            Review
        </div>

        <div class="review__content-wrap">
            <div class="review__content">
                <div class="review__title">
                    <img class="shop__image" src="{{ $shop->image_url }}" alt="イメージ写真">
                </div>
                <div class="review__area">
                    <p class="reservation__group">来店日時
                        <span class="reservation__date">{{ $reservation->date }}</span>
                        <span class="reservation__time">{{ date('H:i',strtotime($reservation->time)) }}～</span>
                    </p>
                    <p class="shop__name">{{ $shop->name }}</p>
                    <p class="shop__detail">{{ $shop->outline }}</p>
                </div>
            </div>

            <form action="{{ route('review.store',$reservation) }}" method="post" class="review__form">
                @csrf
                <div class="review__content">
                    <div class="review__title review__title--vertical-center">
                        評価（5段階）
                    </div>
                    <div class="review__area">
                        <span class="review__rating">
                            @for ($i = 5; $i >= 1 ; $i--)
                                <input id="star0{{ $i }}" type="radio" name="rating" value="{{ $i }}" class="rating__star" {{ $reservation->review && $reservation->review->rating == $i ? 'checked' : '' }}>
                                <label for="star0{{ $i }}" class="rating__star-label">★</label>
                            @endfor
                        </span>
                    </div>
                </div>

                <div class="review__content">
                    <div class="review__title">
                        レビュー内容
                    </div>
                    <div class="review__area">
                        <textarea class="review__textarea" name="comment" rows="8">{{ $reservation->review->comment ?? '' }}</textarea>
                    </div>
                </div>
                <div class="form__button">
                    <a href="/mypage" class="back__button">戻る</a>
                    <button type="submit" class="form__button-btn">
                        {{ $reservation->review ? '編集する' : '投稿する' }}
                    </button>
                </div>
            </form>
        </div>
        <div class="review">
    </div>
@endsection