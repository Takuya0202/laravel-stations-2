<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>座席一覧</title>
</head>
<body>
    <h1>予約する席をお選びください</h1>
    <table border="1">
        @foreach ($sheets as $row => $elements)
            <tr>
                @foreach ($elements as $elem)
                    <td>
                        <form action="{{route('reservation.create',['movie_id' => $movie_id , 'schedule_id' => $schedule_id])}}" method="get">
                            <input type="text" name="sheetId" value="{{$elem->id}}" hidden>
                            <input type="text" name="date" value="{{$date}}" hidden>
                            <button type="submit">{{$elem->row}}-{{$elem->column}}</button>
                        </form>
                    </td>
                @endforeach
            </tr>
        @endforeach
    </table>
    <p><a href="{{route('mv.show' , ['id' => $movie_id])}}">戻る</a></p>
</body>
</html>
