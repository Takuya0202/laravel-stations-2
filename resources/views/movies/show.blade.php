<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>映画詳細</title>
</head>
<body>
    <h1>映画内容</h1>
    <table border="1">
        <thead>
            <th>タイトル</th>
            <th>映画url</th>
            <th>公開年</th>
            <th>公開状況</th>
            <th>概要</th>
            <th>タグ</th>
        </thead>
        <tr>
            <td>{{$mv->title}}</td>
            <td><img src="{{$mv->image_url}}" alt=""></td>
            <td>{{$mv->published_year}}</td>
            <td>{{$mv->is_showing ? '上映中' : '上映予定'}}</td>
            <td>{{$mv->description}}</td>
            <td>{{$mv->genre->name}}</td>
        </tr>
    </table>
    @if (session('message'))
        {{session('message')}}
    @endif
    <h2>ID:{{$mv->id}} 映画タイトル：{{$mv->title}}のスケジュール一覧</h2>
    <ul>
        @foreach ($schedules as $sc)
            <li>開始時刻：{{$sc->start_time}}~終了時刻{{$sc->end_time}}</li>
            <form action="{{route('reservation.index', ['movie_id' => $mv->id , 'schedule_id' => $sc->id] )}}" method="get">
                <input type="text" name="date" value="{{now()}}" hidden>
                <button type="submit">座席を予約する</button>
            </form>
        @endforeach
    </ul>
    {{-- <ul>
        @foreach ($schedules as $sc)
            <li><a href="{{route('admin.schedules.show' , ['id' => $sc->id ])}}">上映開始：{{$sc->start_time}}</a></li>
            <li><a href="{{route('admin.schedules.show' , ['id' => $sc->id ])}}">上映終了；{{$sc->end_time}}</a></li>
            @if ($loop->last)
            <p><a href="{{route('admin.schedules.create' , ['id' => $mv->id])}}">新しいスケジュールを追加</a></p>
            @endif
        @endforeach
    </ul> --}}
    <p><a href="{{route('home')}}">戻る</a></p>
</body>
</html>
