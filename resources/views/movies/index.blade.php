<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>映画一覧</title>
</head>
<body>
  <ul>
    @foreach ($movies as $mv)
      <li>映画タイトル：{{$mv->title}}</li>
      <img src="{{$mv->image_url}}" alt="">
    @endforeach
  </ul>
</body>
</html>
