<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>削除確認</title>
</head>
<body>
    <form action="{{route('mv.destroy' , ['id' => $mv->id])}}" method="post">
        @csrf
        @method('DELETE')
        <h2>本当に{{$mv->title}}を削除しますか？</h2>
        <button type="submit">削除する</button>
        <p><a href="{{route('admin.home')}}">戻る</a></p>
    </form>
</body>
</html>
