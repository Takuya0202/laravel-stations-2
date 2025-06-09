<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>映画一覧：管理者</title>
</head>
<body>
  <table>
    <thead>
      <th>映画タイトル</th>
      <th>映画url</th>
      <th>公開年</th>
      <th>公開情報</th>
      <th>概要</th>
    </thead>
  @foreach ($movies as $mv)
    <tr>
      <td>{{$mv->title}}</td>
      <td>{{$mv->image_url}}</td>
      <td>{{$mv->published_year}}</td>
      <td>{{$mv->is_showing ? '上映中' : '上映予定'}}</td>
      <td>{{$mv->description}}</td>
    </tr>
  @endforeach
  </table>
  <p><a href="{{route('mv.create')}}">映画を追加</a></p>
</body>
</html>
