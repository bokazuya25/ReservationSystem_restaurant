@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
    <div class="auth__wrap">
        <div class="auth__header">
            Login
        </div>
        <form action="" class="form__item">
            <div class="form__item-mail">
                <input type="email" class="form__input-item" placeholder="Email">
            </div>
            <div class="form__item-key">
                <input type="password" class="form__input-item" placeholder="Password">
            </div>
            <button type="submit" class="form__item-button">ログイン</button>
        </form>
    </div>
@endsection