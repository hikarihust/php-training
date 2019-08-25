<?php
    function callback($buffer) {
        $buffer = str_replace('PHP', 'Html', $buffer);
        return $buffer;
    }

    ob_start('callback');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>PHP is easy</h1>
</body>
</html>

<?php
    ob_end_flush();
?>