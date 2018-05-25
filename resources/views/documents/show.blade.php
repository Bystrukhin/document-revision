<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <h2>{{ $document->title }}</h2>
        <div>{{ $document->body }}</div>

        <hr>

        <ul>

            @foreach($document->revisions as $user)
                <li>
                    {{ $user->name }} on {{ $user->pivot->updated_at->diffForHumans() }}
                </li>
            @endforeach

        </ul>


</body>
</html>