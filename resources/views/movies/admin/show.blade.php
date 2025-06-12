<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>映画タイトル：{{$mv->title}} 映画URL:{{$mv->image_url}}公開年:{{$mv->published_year}} 公開状況:{{$mv->is_showing ? '上映中' : '上映予定'}} 概要：{{$mv->description}}</h2>
    <ul>
        @foreach ($mv->schedules as $sc)
            <li>開始時刻：{{$sc->start_time}}~終了時刻{{$sc->end_time}}</li>
        @endforeach
    </ul>
    <p><a href="{{route('admin.home')}}">戻る</a></p>
</body>
</html>
