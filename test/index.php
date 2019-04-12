<!--first-->
<?php
//
//$str = 'Давайте устроим встречу 20.05.2022 и потом ещё одну 12.06.2022';
//// ЗДЕСЬ НУЖЕН КОД
//
//$days = [
//    'Вс' ,
//    'Пн' ,
//    'Вт' ,
//    'Ср' ,
//    'Чт' ,
//    'Пт' ,
//    'Сб' ,
//];
//
//$datePattern = '/(\d{2}.\d{2}.\d{4})/';
//
//if ( preg_match_all ( $datePattern , $str , $matches ) ) {
//    foreach ($matches[ 0 ] as $key => $value) {
//        $date[] = $matches[ 0 ][ $key ];
//        $dateReplacement[] = $days[ date ( "w" , strtotime ( $date[ $key ] ) ) ];
//
//        $str = str_replace ( $matches[ 0 ][ $key ] , $matches[ 0 ][ $key ] . ' (' . $dateReplacement[ $key ] . ')' , $str );
//    }
//}
//
//
//echo $str; // Давайте устроим встречу 20.05.2022 (пт) и потом ещё одну 12.06.2022 (вс)
?>


<!--second-->
<?php
//
//// ЗДЕСЬ НУЖЕН КОД
//
///**
// * @param  integer
// * @return void
// * Возвращает рандомую строку
// */
//function captcha ($length)
//{
//    $letters = 'FGJLINQRSVWZ1234567890';
//    $captcha = '';
//
//    for ($i = 0; $i < $length; $i++) {
//        $captcha .= substr ( $letters , rand ( 1 , strlen ( $letters ) ) - 1 , 1 );
//    }
//
//    //На всякий пожарный перемешиваем еще раз
//    $captchaArray = str_split ( $captcha );
//    shuffle ( $captchaArray );
//    $captcha = implode ( '' , $captchaArray );
//    echo $captcha;
//}
//
//captcha ( 6 );
//
//?>

<!--third-->
<?php
//
//// ЗДЕСЬ НУЖЕН КОД
//class Vector
//{
//    /**
//     * Создаем скрытый массив для вектора
//
//    */
//    private $vector = array ();
//
//    /**
//     * Vector constructor.
//     * @param array
//     */
//    public function __construct ($vector)
//    {
//        $this->vector = $vector;
//    }
//
//    /**
//     * @return array
//     * Было непонятно какую функцию должен был выполнять toArray , в моем случае это простой гетте
//     */
//    public function toArray ()
//    {
//        return $this->vector;
//    }
//
//    /**
//     * @param integer
//     * @return void
//     * Выполняем сложение вектора
//     */
//    public function add ($number)
//    {
//        foreach ($this->vector as $key => $value) {
//            $this->vector[ $key ] += $number;
//        }
//    }
//
//    /**
//     * @param integer
//     * @return void
//     * Выполняем умножение вектора
//     */
//    public function multi ($number)
//    {
//        foreach ($this->vector as $key => $value) {
//            $this->vector[ $key ] *= $number;
//        }
//    }
//
//
//}
//
//$v = new Vector( [ 1 , 14 , 52 ] );
//
//$v->add ( 42 );
//echo implode ( ', ' , $v->toArray () ) , "\n"; // 43, 56, 94
//
//$v->multi ( -1.2 );
//echo implode ( ', ' , $v->toArray () ) , "\n"; // -51.6, -67.2, -112.8
//?>

<!--amoCRM-->

<?php
//$directory = __DIR__ . '/../../htdocs';
//function tree ($directory , $space)
//{
//    $scan = array_diff ( scandir ( $directory ) , array ( '..' , '.' ) );
//    foreach ($scan as $file) {
//        if ( is_dir ( $directory . '/' . $file ) ) {
//            echo $space . '/' . $file . "<br>";
//            $space .= "&nbsp;&nbsp;&nbsp;&nbsp;";
//            tree ( $directory . '/' . $file , $space );
//        } elseif ( is_file ( $directory . '/' . $file ) ) {
//            echo $space . $file . "<br>";
//        }
//    }
//}
//
//tree ( $directory , null );
//?>
<?php
//function pluralForm ( $n , $form1 , $form2 , $form5 )
//{
//    $type=$n;
//    $n = abs ( $n ) % 100;
//    $n1 = $n % 10;
//    if ( $n > 10 && $n < 20 ) return $type.' '.$form5;
//    if ( $n1 > 1 && $n1 < 5 ) return $type.' '.$form2;
//    if ( $n1 == 1 ) return $type.' '.$form1;
//    return $type.' '.$form5;
//}
//
//for ( $i = 100; $i <= 150; $i++ ) {
//    echo pluralForm ( $i , 'программист' , 'программиста' , 'программистов' ) . "<br/>";
//}
//
//
//?>
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

<form>
    <input type="text" name="inputWord" onchange="f()">
</form>
<div id="word"></div>
<script>
  function f () {
  $("#word").html("<b>"+$("input[name='inputWord']").val()+"</b>");
  }
</script>