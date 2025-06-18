<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スケジュール編集ページ</title>
</head>
<body>
    <form action="{{route('admin.schedules.update' , ['id' => $sc->id])}}" method="post">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @csrf
        @method('PATCH')
        <label for="">映画ID</label>
        <input type="text" name="movie_id" id="" value="{{$sc->movie_id}}" readonly><br>
        <select name="screen_id" id="">
            @foreach ($screens as $screen)
                <option value="{{$screen->id}}" @selected($screen->id == old('screen_id',$sc->screen_id))>{{$screen->name}}</option>
            @endforeach
        </select><br>
        <label for="">上映開始日時</label>
        <input type="text" name="start_time_date" value="{{old('start_time_date',$sc->start_time->format('Y-m-d'))}}"><br>
        <label for="">上映開始時刻</label>
        <input type="text" name="start_time_time" value="{{old('start_time_time',$sc->start_time->format('H:i'))}}"><br>
        <label for="">上映終了日時</label>
        <input type="text" name="end_time_date" value="{{old('end_time_date',$sc->end_time->format('Y-m-d'))}}"><br>
        <label for="">上映終了時刻</label>
        <input type="text" name="end_time_time" value="{{old('end_time_time',$sc->end_time->format('H:i'))}}"><br>
        <button type="submit">追加</button>
    </form>
    <p><a href="{{route('admin.schedules.index')}}">戻る</a></p>
</body>
</html>
