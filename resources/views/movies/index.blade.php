<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>映画一覧</title>
</head>
<body>
  {{-- 検索フォーム --}}
  <form action="{{route('home')}}" method="get">
    <p>キーワード検索</p>
    <input type="text" name="keyword" id="" value="{{request('keyword')}}">
    <label for="">
        上映中
        <input type="radio" name="is_showing" value="1" @checked(request('is_showing') == 1)>
    </label>
    <label for="">
        上映予定
        <input type="radio" name="is_showing" value="0" @checked(request('is_showing') == 0)>
    </label>
    <button type="submit">検索</button>
  </form>
  <ul>
    @foreach ($movies as $mv)
      <li>映画タイトル：<a href="{{route('mv.show' , ['id' => $mv->id])}}">{{$mv->title}}</a></li>
      <li>映画URL : {{$mv->image_url}}</li>
      <li>公開状況：{{$mv->is_showing}}</li>
    @endforeach
  </ul>
</body>
</html>
