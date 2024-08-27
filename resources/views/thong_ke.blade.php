<!doctype html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<table style="border: 1px solid #ddd;">
    <tr>
        <th colspan="{{count($all_phones)}}">{{$currentDay->date}}</th>
    </tr>
    <tr>
        @foreach($all_phones as $phone)
            <th>máy {{$phone->name}}</th>
        @endforeach
    </tr>
    <tr>
        @foreach($all_phones as $phone)
            @php
                $all_chips_line = "";
                foreach($phone->nicknames as $nickname){
                    $all_chips_line .="<p>" . $nickname->nickname . ":" . $nickname->chip."</p>";
                }
            @endphp

            <td>{!!$all_chips_line!!}</td>
        @endforeach
    </tr>




</table>
</body>
</html>
