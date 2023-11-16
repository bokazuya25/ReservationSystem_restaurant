<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約リマインダー</title>
</head>
<body>
    <p>{{ $reservation->user->name }} 様</p>
    <p>以下の内容で予約を受け付けています。</p>
    <p>店舗名：{{ $reservation->shop->name }}</p>
    <p>予約日: {{ $reservation->date }}</p>
    <p>予約時間：{{ date('H:i',strtotime($reservation->time)) }}</p>
    <p>予約人数：{{ $reservation->number }}</p>
    <p>本日お待ちしております！</p>
</body>
</html>
