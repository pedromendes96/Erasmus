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

<form method="post" action="/uploadfiles" enctype="multipart/form-data">
    file1<input type="file" name="file1">
    <br>
    file2<input type="file" name="file2">
    <br>
    file3<input type="file" name="file3">
    <br>
    file4<input type="file" name="file4">
    <br>
    file5<input type="file" name="file5">
    <br>
    file6<input type="file" name="file6">
    <br>
    @if (session('notPDF'))
    <b>Please submit only pdf type files!</b>
        <br>
    @endif
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="submit">
</form>
</body>
</html>