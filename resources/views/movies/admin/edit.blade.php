<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>映画追加フォーム</title>
</head>
<body>
  <form action="{{route('mv.update' , ['id' => $mv->id])}}" method="post">
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
    <p for="">映画名を入力</p>
    <input type="text" name="title" value="{{old('title' , $mv->title)}}">
    <p for="">映画名urlを入力</p>
    <input type="text" name="image_url" value="{{old('image_url' , $mv->image_url)}}">
    <p for="">公開された年を入力</p>
    <input type="number" name="published_year" value="{{old('published_year' , $mv->published_year)}}">
    <p>公開状況</p>
    <label for="">
        公開中
        <input type="radio" name="is_showing" id="" value="1" @checked($mv->is_showing == 1)>
    </label>
    <label for="">
        公開予定
        <input type="radio" name="is_showing" id="" value="0" @checked($mv->is_showing == 0)>
    </label>
    <p>
        概要
        <textarea name="description" id="" cols="30" rows="10">{{old('description' , $mv->description)}}</textarea>
    </p>
    <p>
        ジャンルを入力
        <input type="text" name="genre" value="{{old('genre' , $mv->genre->name)}}">
    </p>
    <button type="submit">追加</button>
    <p><a href="{{route('admin.home')}}">戻る</a></p>
  </form>
</body>
</html>
