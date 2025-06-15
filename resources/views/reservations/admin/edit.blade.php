<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>新規予約追加</h1>
    <form action="{{route('admin.reservation.update', ['id' => $reservation->id])}}" method="post">
        @csrf
        @method('PATCH')
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <select name="sheet_id" id="">
            @foreach ($sheets as $sheet)
                <option value="{{$sheet->id}}" @selected($sheet->id == old('sheet_id',$reservation->sheet_id))>{{$sheet->row}}~{{$sheet->column}}</option>
            @endforeach
        </select>
        <br>

        <select name="schedule_id" id="">
            @foreach ($schedules as $sc)
                <option value="{{$sc->id}}" @selected($sc->id == old('schedule_id',$reservation->schedule_id))>{{$sc->start_time->format('Y-m-d')}}~{{$sc->end_time->format('Y-m-d')}}</option>
            @endforeach
        </select>
        <br>

        <label for="email">
            予約するemailを入力してください
            <input type="email" name="email" value="{{old('email',$reservation->email)}}">
        </label>
        <br>

        <label for="name">
            予約者の名前を入力してください
            <input type="text" name="name" value="{{old('name',$reservation->name)}}">
        </label>
        <br>

        {{-- hiddenでdateを送信 --}}
        <input type="text" name="date" value="{{now()->format('Y-m-d')}}" hidden>


        {{-- テストケースでmovie_idが必要なのでhiddenで送信する --}}
        <input type="text" name="movie_id" value="1" hidden>

        <button type="submit">予約する</button>
        <p><a href="{{route('admin.reservation.index')}}">戻る</a></p>
    </form>
</body>
</html>
