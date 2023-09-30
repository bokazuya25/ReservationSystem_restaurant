@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
    <div class="content__wrap">
        <p class="content__text">
            会員登録ありがとうございます
        </p>
        <a type="submit" class="content__button" onclick="loction.href='/login'">ログインする</a>
    </div>
@endsection