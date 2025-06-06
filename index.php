<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEBUG</title>
</head>

<body>
    <pre>
        <?php
        include('src/index.php');
        $data = ['foo' => 'bar', 'baz' => [1, 2, 3]];
        dd($data);

        ?>
    </pre>
</body>

</html>
