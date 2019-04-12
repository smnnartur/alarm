<?php
require_once 'Zodiac.php';
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Zodiac</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<form action="index.php" method="post">
    <input type="date" name="date">
    <input type="submit" value="Узнать знак зодиака">
</form>
<h3><?php echo Zodiac::sign (); ?></h3>

<img src="images/<?php echo Zodiac::sign (); ?>.jpg" alt="<?php echo Zodiac::sign (); ?>"/>

</body>
</html>
