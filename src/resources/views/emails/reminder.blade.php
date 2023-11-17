@component('mail::message')
# Reseからのお知らせ

## {{ $reservation->user->name }} 様

以下の内容で予約を受け付けています。

- 店舗名： {{ $reservation->shop->name }}
- 予約日： {{ \Carbon\Carbon::parse($reservation->date)->locale('ja')->isoFormat('YYYY-MM-DD (dd)') }}
- 予約時間： {{ date('H:i',strtotime($reservation->time)) }}
- 予約人数： {{ $reservation->number }}人

本日お待ちしております！

Thanks,{{ config('app.name') }}
@endcomponent
