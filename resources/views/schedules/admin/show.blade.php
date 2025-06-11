<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スケジュール詳細</title>
</head>
<body>
    <ul>
        <li>開始時間：{{$sc->start_time}}</li>
        <li>終了時間:{{$sc->end_time}}</li>
        <li>映画名：{{$sc->movie->title}}</li>
        <li>映画URL:{{$sc->movie->image_url}}</li>
        <li>概要：{{$sc->movie->description}}</li>
    </ul>
    <p><a href="{{route('admin.schedules.edit' , ['scheduleId' => $sc->id])}}">編集する</a></p>
    <form action="{{route('admin.schedules.delete' , ['scheduleId' => $sc->id])}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">削除する</button>
    </form>
    <p><a href="{{route('admin.schedules.index')}}">戻る</a></p>
</body>
</html>
