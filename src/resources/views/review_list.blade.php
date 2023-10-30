@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
    <link rel="stylesheet" href="{{ asset('css/review_list.css') }}">
@endsection

@section('content')
    <div class="review__wrap">
        <div class="review__header">
            Reviews
        </div>

        <div class="review__container">
            <div class="shop__data">
                <div class="shop__image">
                    <img class="shop__image-img" src="{{ $shop->image_url }}" alt="イメージ写真">
                </div>
                <div class="shop__data-area">
                    <p class="shop__name">{{ $shop->name }}</p>
                    <span class="rating__name">総合評価：</span>
                    <span class="rating__star" data-rate="{{ number_format($avgRating,1) }}"></span>
                    <span class="rating__number">{{ number_format($avgRating,1) }}</span>
                    <p class="shop__detail">{{ $shop->outline }}</p>
                </div>
            </div>

            @foreach ($shopReviews as $shopReview)
                <div class="review__content-wrap">
                    <div class="review__content">
                        <div class="review__title review__title--vertical-center">
                            評価（5段階）
                        </div>
                        <div class="review__area">
                            <span class="rating__star" data-rate="{{ number_format($shopReview->rating,1) }}"></span>
                            <span class="rating__number">{{ number_format($shopReview->rating,1) }}</span>
                        </div>
                    </div>

                    <div class="review__content">
                        <div class="review__title">
                            レビュー内容
                        </div>
                        <div class="review__area">
                            <p class="review__comment">{{ $shopReview->comment }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="{{ asset('js/detail.js') }}"></script>
@endsection