<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザー登録</title>
</head>
<body>
    <form action="{{route('user.store')}}" method="post">
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
        <label for="">
            ユーザー名
            <input type="text" name="name" value="{{old('name')}}">
        </label><br>
        <label for="">
            メールアドレス
            <input type="email" name="email" value="{{old('email')}}">
        </label><br>
        <label for="">
            パスワード設定
            <input type="password" name="password" value="{{old('password')}}">
        </label><br>
        <label for="">
            パスワード確認
            <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}">
        </label><br>
        <button type="submit">登録する</button>
    </form>
</body>
</html>
