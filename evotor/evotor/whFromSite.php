<?php
header ( 'Content-Type: text/html; charset=utf-8' );

/**
 * Class Evotor
 */
class Evotor
{

    /**
     * Создает рандомный 4uuid
     * @return string
     */
    public static function gen_uuid ()
    {
        return sprintf ( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x' ,
            // 32 bits for "time_low"
            mt_rand ( 0 , 0xffff ) , mt_rand ( 0 , 0xffff ) ,

            // 16 bits for "time_mid"
            mt_rand ( 0 , 0xffff ) ,

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand ( 0 , 0x0fff ) | 0x4000 ,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand ( 0 , 0x3fff ) | 0x8000 ,

            // 48 bits for "node"
            mt_rand ( 0 , 0xffff ) , mt_rand ( 0 , 0xffff ) , mt_rand ( 0 , 0xffff )
        );
    }


    /**
     * Инициализация CURL по адресу
     * @param $urlapi
     * @return mixed
     */
    public static function initCurl ( $urlapi )
    {
        $username = 'superviser@dmitriy12';
        $password = 'F1o55yi9';
        $ch = curl_init ();
        curl_setopt ( $ch , CURLOPT_URL , $urlapi );
        curl_setopt ( $ch , CURLOPT_RETURNTRANSFER , true );
        curl_setopt ( $ch , CURLOPT_USERPWD , "$username:$password" );
        curl_setopt ( $ch , CURLOPT_HTTPAUTH , CURLAUTH_BASIC );
        $output = curl_exec ( $ch );
        curl_close ( $ch );
        return json_decode ( $output , true );
    }

    /**
     * Создает массив товаров
     * @return false|string
     */
    public function getVariant ()
    {
        $arr = [];
        $offset = 0;
        $prod_offset = 0;

        $prod = [];
        $assortment_offset = 0;

        do {
            $assortment_urlapi = "https://online.moysklad.ru/api/remap/1.1/entity/assortment?limit=50&offset=$assortment_offset";
            $decode = self::initCurl ( $assortment_urlapi );
            foreach ( $decode[ 'rows' ] as $assortment_row ) {
                if ( isset( $assortment_row[ 'name' ] ) ) {
                    $assortment[ $assortment_row[ 'name' ] ] = $assortment_row;
                    $assortment[ $assortment_row[ 'code' ] ] = $assortment_row;

                    echo "<pre>";
                    var_dump ( $assortment_row );
                    echo "</pre>";
                }
            }

            $assortment_offset += 50;
        } while (!empty( $decode[ 'rows' ] ));

        do {
            $prod_urlapi = "https://online.moysklad.ru/api/remap/1.1/entity/product?limit=50&offset=$prod_offset";
            $decode = self::initCurl ( $prod_urlapi );
            foreach ( $decode[ 'rows' ] as $prod_row ) {
                $prod[ $prod_row[ 'meta' ][ 'href' ] ] = $prod_row;
//                echo "<pre>";
//                var_dump ( $prod_row );
//                echo "</pre>";
            }

            $prod_offset += 50;
        } while (!empty( $decode[ 'rows' ] ));

        do {
            $urlapi = "https://online.moysklad.ru/api/remap/1.1/entity/variant?limit=50&offset=$offset";
            $decode = self::initCurl ( $urlapi );

            foreach ( $decode[ 'rows' ] as $row ) {
                $sub_urlapi = $row[ "product" ][ "meta" ][ "href" ];
                $sub_decode = $prod[ $sub_urlapi ];
                $assortment_deocde = $assortment[ $row[ 'name' ] ];

                $variants[ 'uuid' ] = self::gen_uuid ();
                $variants[ 'code' ] = $sub_decode[ 'code' ] . '#' . $row[ 'code' ];
                $variants[ 'barCodes' ] = $row[ 'barcodes' ];
                $variants[ 'name' ] = $row[ 'name' ];
                $variants[ 'price' ] = (float)sprintf ( "%.2f" , $row[ 'salePrices' ][ 0 ][ 'value' ] / 100 );
                $variants[ "quantity" ] = $assortment_deocde[ 'quantity' ];
                $variants[ 'costPrice' ] = (float)sprintf ( "%.2f" , $sub_decode[ 'buyPrice' ][ 'value' ] / 100 );
                $variants[ 'measureName' ] = "шт";
                $variants[ 'tax' ] = "NO_VAT";
                $variants[ 'allowToSell' ] = true;
                $variants[ 'description' ] = !empty( $row[ 'description' ] ) ? $row[ 'description' ] : null;
                $variants[ 'articleNumber' ] = !empty( $row [ 'article' ] ) ? $row [ 'article' ] : null; //
                $variants[ 'parentUuid' ] = null;
                $variants[ 'group' ] = false;
                $variants[ 'type' ] = "NORMAL";

                $arr[] = $variants;
            }
            $offset += 50;
        } while (!empty( $decode[ 'rows' ] ));

        $json_data = json_encode ( $arr );
        fopen ( 'json_data.json' , 'w' );
        file_put_contents ( 'json_data.json' , $json_data );

//        echo "<pre>";
//        var_dump ( $arr );
//        echo "</pre>";
        return $json_data;
    }

    /**
     * Загрузка товаров
     * @return void
     */
    public function pushOnEvotor ()
    {
        $data_json = file_get_contents ( 'json_data.json' );

        $username = 'vnovikov@kit-consulting.ru';
        $password = 'forruv-jywpoq-0dEnhe';
        $store_id = '20180323-F567-406C-80EB-C507AF541F57';
        $token = '5c2545af-3036-489f-8837-d0d0b8832f71';

        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Cache-Control: no-cache, must-revalidate';
        $headers[] = "X-Authorization: $token";

//        $headers[] = 'Content-Type: application/x-www-form-urlencoded;charset=utf-8';


        $ch = curl_init ();
        curl_setopt ( $ch , CURLOPT_URL , "https://api.evotor.ru/api/v1/inventories/stores/$store_id/products" );
        curl_setopt ( $ch , CURLOPT_RETURNTRANSFER , true );
//        curl_setopt ( $ch , CURLOPT_USERPWD , "$username:$password" );
//        curl_setopt ( $ch , CURLOPT_HTTPAUTH , CURLAUTH_BASIC );
        curl_setopt ( $ch , CURLOPT_HTTPHEADER , $headers );
//        curl_setopt ( $ch , CURLOPT_POST , 1 );
//        curl_setopt ( $ch , CURLOPT_POSTFIELDS , $data_json );

        $response = curl_exec ( $ch );
        curl_close ( $ch );
        echo "<pre>";
        print_r ( json_decode ( $response , true ) );
        echo "</pre>";

        file_put_contents ( 'whFromSite.log' , print_r ( json_decode ( $response , true ) , 1 ) , FILE_APPEND );
//        var_dump ( json_decode ( $response , true )[ 0 ][ 'uuid' ] ); //// 20180323-F567-406C-80EB-C507AF541F57

    }

}

$object = new Evotor();
$object->pushOnEvotor ();
//$object->getVariant ();
