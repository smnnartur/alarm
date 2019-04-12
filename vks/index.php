<?php include_once __DIR__ . '/model.php' ?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>

    </title>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
    <script type="text/javascript" src="//code.jquery.com/jquery-2.0.2.js"></script>
    <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>


</head>
<body>
<form>
    <input type="text" name="name">
    <input type="email" name="email">
    <input type="text" name="number">
    <select name="school">
        <?php
        foreach (vksModel::school () as $item){
            echo '<option>'.$item['school'].'</option>';
        }
        ?>
    </select>
    <input type="submit" value="отправить">
</form>

</body>
</html>