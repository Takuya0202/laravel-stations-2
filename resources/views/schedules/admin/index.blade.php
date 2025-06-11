<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($movies as $mv)
        <h2>作品ID:{{$mv->id}} 作品名：{{$mv->title}}</h2>
        @foreach ($mv->schedules as $sch)
            <ul>
                <li><a href="{{route('admin.schedules.show' , ['id' => $sch->id ])}}">開始時間：{{$sch->start_time}} 終了時間:{{$sch->end_time}}</a></li>
            </ul>
        @endforeach
    @endforeach
</body>
</html>
