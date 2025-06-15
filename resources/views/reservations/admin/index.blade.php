<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>予約一覧</title>
</head>
<body>
    <table border="1">
        @if (session('message'))
            {{session('message')}}
        @endif
        <h1>予約一覧</h1>
        <thead>
            <th>映画作品</th>
            <th>座席</th>
            <th>日時</th>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>編集</th>
            <th>削除</th>
        </thead>
        @foreach ($reservations as $elem)
            <tr>
                <td>{{$elem->schedule->movie->title}}</td>
                <td>{{strtoupper($elem->sheet->row . $elem->sheet->column)}}</td>
                <td>{{$elem->date}}</td>
                <td>{{$elem->name}}</td>
                <td>{{$elem->email}}</td>
                <td>
                    <form action="{{route('admin.reservation.edit' , ['id' => $elem->id])}}" method="get">
                        <button type="submit">編集</button>
                    </form>
                </td>
                <td>
                    <form action="{{route('admin.reservation.delete' , ['id' => $elem->id])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <p><a href="{{route('admin.reservation.create')}}">新しく予約を追加する</a></p>
</body>
</html>
