<?php
if ( isset( $_POST[ 'submit' ] ) ) {
    if ( isset( $_FILES ) && $_FILES['file']['error'] == 0) {
        $dir = dirname ( __FILE__ ) . '/' . $_FILES[ 'file' ][ 'name' ];
        move_uploaded_file ( $_FILES[ 'file' ][ 'tmp_name' ] , $dir );
        echo 'Фалй отправлен';
    } else {
        echo 'Ошибка Загрузки';
    }
}
?>
<html>
<head>
    <title>File</title>
    <meta charset="utf-8">
</head>
<body>
<form action="test.php" method='post' enctype="multipart/form-data">
    <input name="file" type="file"/>
    <input type="submit" value="загрузить" name="submit"/>
</form>
</body>
</html>