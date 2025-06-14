<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>予約フォーム</title>
</head>
<body>
    @if (session('message'))
        {{session('message')}}
    @endif
    <h1>映画ID:{{$movie_id}} スケジュールID:{{$schedule_id}} 座席ID:{{$sheet_id}}のご予約</h1>
    <p>日付：{{$date}}</p>

    <form action="{{route('reservation.store')}}" method="POST">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <input type="text" name="movie_id" value="{{$movie_id}}" hidden>
        <input type="text" name="schedule_id" value="{{$schedule_id}}" hidden>
        <input type="text" name="sheet_id" value="{{$sheet_id}}" hidden>
        <input type="text" name="date" value="{{$date}}" hidden>
        <label for="email">
            メールアドレス
        <input type="email" name="email" id="email" value="{{old('email')}}"><br>
        </label>
        <label for="name">
            予約者のお名前
        <input type="text" name="name" id="name" value="{{old('name')}}"><br>
        </label>

        <button type="submit">予約する</button>
    </form>


</body>
</html>
