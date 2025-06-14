<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>座席一覧</title>
</head>
<body>
    <h1>座席一覧</h1>
    <table border="1">
        @foreach ($sheets as $row => $elements)
            <tr>
                @foreach ($elements as $elem)
                    <td>
                        {{$elem->row}}-{{$elem->column}}
                    </td>
                @endforeach
            </tr>
        @endforeach
    </table>
</body>
</html>
