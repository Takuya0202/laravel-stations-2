<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>映画一覧：管理者</title>
</head>
<body>
  <table border="1">
    <thead>
      <th>映画タイトル</th>
      <th>映画url</th>
      <th>公開年</th>
      <th>公開情報</th>
      <th>概要</th>
      <th>タグ</th>
      <th>編集</th>
      <th>削除</th>
      <th>詳細</th>
    </thead>
  @foreach ($movies as $mv)
    <tr>
      <td>{{$mv->title}}</td>
      <td>{{$mv->image_url}}</td>
      <td>{{$mv->published_year}}</td>
      <td>{{$mv->is_showing ? '上映中' : '上映予定'}}</td>
      <td>{{$mv->description}}</td>
      <td>{{$mv->genre->name}}</td>
      <td><p><a href="{{route('mv.edit' , ['id' => $mv->id])}}">編集</a></p></td>
      <td><p><a href="{{route('mv.confirme' , ['id' => $mv->id])}}">削除</a></p></td>
      <td><p><a href="{{route('mv.show' , ['id' => $mv->id])}}">詳細</a></p></td>
    </tr>
  @endforeach
  </table>
  <ul>
    @foreach ($genres as $genre)
        <li>{{$genre->name}}</li>
    @endforeach
  </ul>
  <p><a href="{{route('mv.create')}}">映画を追加</a></p>
</body>
</html>
