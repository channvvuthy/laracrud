<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{route('paypal')}}" method="post">
    {{csrf_field()}}
        <h2>Product: Mobile Phone</h2>
        <h3>Price: $20</h3>
        <input type="hidden" name="price" value="20">
        <input type="submit" value="submit">

    </form>
</body>

</html>