<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <form action="submit_offline_order" method="post">
        @csrf
        <input type="text" name="total_price" id="total_price">

        <button type="submit">
            Submit
        </button>
    </form>
</body>
</html>
