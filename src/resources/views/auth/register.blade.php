@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
    <div class="auth__wrap">
        <div class="auth__header">
            Registration
        </div>
        <form action="" class="form__item">
            <div class="form__item-user">
                <input type="text" class="form__input-item" placeholder="Username">
            </div>
            <div class="form__item-mail">
                <input type="email" class="form__input-item" placeholder="Email">
            </div>
            <div class="form__item-key">
                <input type="password" class="form__input-item" placeholder="Password">
            </div>
            <button type="submit" class="form__item-button">登録</button>
        </form>
    </div>
@endsection