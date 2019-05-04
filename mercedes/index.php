<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Mercedes
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<style>
    .container-fluid {
        margin-top: 5px;
    }

    .date, .time {
        margin-top: 10px;
        height: 50px;
        text-align: center;
        font-size: 30px;
    }
</style>
<body>

<?php
/**
 * Class ActiveRecord
 */
class ActiveRecord
{
    /**
     * @return PDO
     * Соединение Базы Данных
     */
    public static function DB ()
    {
        try {
            $DB = new PDO( 'mysql:host=localhost;dbname=mercedes' , 'artur' , 'alfa12345' );
            return $DB;
        } catch ( PDOException $e ) {
            print "Error!: " . $e->getMessage () . "<br/>";
            die();
        }
    }

    /**
     * @param $date
     * @param $time
     * Добавление в базу данных
     */
    public static function insert ( $date , $time )
    {
        $stmt = self::DB ()->prepare ( "INSERT INTO mercedes VALUES (NULL,:date, :time)" );
        $stmt->bindParam ( ':date' , $date );
        $stmt->bindParam ( ':time' , $time );
        $stmt->execute ();
    }
}

/**
 * Class JsonDateAndTime
 */
class JsonDateAndTime
{
    /**
     * @return mixed
     * Получаем и дэкодим json по ссылке
     */
    public static function getDateAndTime ()
    {
        $date = file_get_contents ( "http://byenlab.com/test/?key=value" , true );
        $decode = json_decode ( $date );
        return $decode;
    }
}

?>
<div class="result"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 col-md-4 ">
            <a class="datebtn btn btn-danger float-left" onclick="date()">Текущая дата</a>
        </div>
        <div class="col-lg-4 col-md-4 text-center">
            <a class="timebtn btn btn-danger " onclick="time()">Текущее время</a>
        </div>
        <div class="col-lg-4 col-md-4 ">
            <a class="database btn btn-danger float-right" onclick="insert()">Записать данные в БД</a>
        </div>

        <div class="date col-lg-6 col-md-6 border border-primary"></div>
        <div class="time col-lg-6 col-md-6 border border-primary"></div>
    </div>
</div>

<script>
    function time () {
        $ ( ".time" ).html ( "<?php echo JsonDateAndTime::getDateAndTime ()->MyTime; ?>" );
        $ ( ".timebtn" ).removeClass ( "btn-danger" ).addClass ( "btn-success" );
    }

    function date () {
        $ ( ".date" ).html ( "<?php echo JsonDateAndTime::getDateAndTime ()->MyDate; ?>" );
        $ ( ".datebtn" ).removeClass ( "btn-danger" ).addClass ( "btn-success" );
    }

    function insert () {
        $ ( '.result' ).html ( "<?php ActiveRecord::insert ( JsonDateAndTime::getDateAndTime ()->MyDate , JsonDateAndTime::getDateAndTime ()->MyTime ) ?>" );
        $ ( '.database' ).html ( "Данные Добавлены в БД" ).removeClass ( "btn-danger" ).addClass ( "btn-success" );
    }
</script>
</body>
</html>