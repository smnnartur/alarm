<?php
require_once 'Converter.php';
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Converter</title>
</head>
<body>

<form action="index.php" method="post">
    <input type="number" placeholder="Километры" name="km">
    <input type="submit" placeholder="Посчитать">
</form>

<h3><?php echo converter::conversion (); ?> м/с</h3>

</body>
</html>
