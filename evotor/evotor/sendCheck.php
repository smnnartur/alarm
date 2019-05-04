<?php
header ( 'Content-Type: text/html; charset=utf-8' );
//file_put_contents ( 'checks.txt' , print_r ( [ $_REQUEST , file_get_contents ( 'php://input' ) ] , 1 ) , FILE_APPEND );
//file_put_contents ( 'get_check.json' , file_get_contents ( 'php://input' ) , FILE_APPEND );
//file_put_contents ( 'evotor_check.json' , file_get_contents ( 'php://input' ) , FILE_APPEND );

$evotor_arr = json_decode ( file_get_contents ( 'php://input' ) , true )[0]; //json_decode ( file_get_contents ( 'php://input' )  )


//evotor Cash and noCash
    $evotor_uuid = $evotor_arr[ 'uuid' ];
    foreach ( $evotor_arr[ "transactions" ] as $transaction ) {
        if ( $transaction[ 'type' ] == 'PAYMENT' ) {
            if ( $transaction[ "paymentType" ] == 'CASH' ) {
                $evotor_cash = (float) $transaction[ 'sum' ] * 100;
                $evotor_no_cash = (float) 0;
            } else {
                $evotor_cash = (float) 0;
                $evotor_no_cash = (float) $transaction[ 'sum' ] * 100;
            }
        }
    }


//get MoySklad variants href
    $prod_offset = 0;
    $result_code = [];
    do {
        $prod_urlapi = "https://online.moysklad.ru/api/remap/1.1/entity/assortment?limit=50&offset=$prod_offset";
        $username = 'superviser@dmitriy12';
        $password = 'F1o55yi9';
        $ch = curl_init ();
        curl_setopt ( $ch , CURLOPT_URL , $prod_urlapi );
        curl_setopt ( $ch , CURLOPT_RETURNTRANSFER , true );
        curl_setopt ( $ch , CURLOPT_USERPWD , "$username:$password" );
        curl_setopt ( $ch , CURLOPT_HTTPAUTH , CURLAUTH_BASIC );
        $output = curl_exec ( $ch );
        curl_close ( $ch );
        $decode = json_decode ( $output , true );

        foreach ( $decode[ 'rows' ] as $prod_row ) {
            foreach ( $evotor_arr[ "transactions" ] as $transaction ) {
                if ( $transaction[ 'type' ] == 'REGISTER_POSITION' ) {
                    if ( strpos ( $transaction[ 'commodityCode' ] , '#' ) ) {
                        $expload = explode ( '#' , $transaction[ 'commodityCode' ] );
                        if ( $expload[ 1 ] == $prod_row[ 'code' ] ) {
                            $result_code[ $transaction[ 'commodityCode' ] ] = $prod_row[ 'meta' ][ 'href' ];
                        }
                    } else {
                        if ( $transaction[ 'commodityCode' ] == $prod_row[ 'code' ] ) {
                            $result_code[ $transaction[ 'commodityCode' ] ] = $prod_row[ 'meta' ][ 'href' ];
                        }
                    }
                }
            }

        }
        $prod_offset += 50;
    } while ( !empty( $decode[ 'rows' ] ) );



//get MoySklad retailshift
    $retail_offset = 0;
    $retail_result = [];
    do {
        $retail_urlapi = "https://online.moysklad.ru/api/remap/1.1/entity/retailshift/?limit=50&offset=$retail_offset";
        $username = 'superviser@dmitriy12';
        $password = 'F1o55yi9';
        $ch = curl_init ();
        curl_setopt ( $ch , CURLOPT_URL , $retail_urlapi );
        curl_setopt ( $ch , CURLOPT_RETURNTRANSFER , true );
        curl_setopt ( $ch , CURLOPT_USERPWD , "$username:$password" );
        curl_setopt ( $ch , CURLOPT_HTTPAUTH , CURLAUTH_BASIC );
        $retail_output = curl_exec ( $ch );
        curl_close ( $ch );
        $decode = json_decode ( $retail_output , true );

        $retail_result[] = end ( $decode[ 'rows' ] )[ 'meta' ][ 'href' ];
        $retail_offset += 50;
    } while ( !empty( $decode[ 'rows' ] ) );


    $name = $evotor_arr[ 'number' ];
    $position = [];

//Создаем массив данных для поля "positions"
    foreach ( $evotor_arr[ "transactions" ] as $transaction ) {
        if ( $transaction[ 'type' ] == 'REGISTER_POSITION' ) {
            $href[ $transaction[ 'commodityCode' ] ] = $result_code[ $transaction[ 'commodityCode' ] ];

            $position[] = [
                "quantity" => (float) $transaction[ 'quantity' ] > 0 ? (float) $transaction[ 'quantity' ] : 1 ,
                "price" => (float) $transaction[ 'resultPrice' ] * 100 ,
                "discount" => 0 ,
                "vat" => 0 ,
                "assortment" => [
                    "meta" => [
                        "href" => $result_code[ $transaction[ 'commodityCode' ] ] ,
                        "type" => "variant" ,
                        "mediaType" => "application/json"
                    ]
                ] ,
            ];
        }
    }

    //Создаем массив для пуша на "МойСклад"
    $moysklad_arr = [
        "retailShift" => [
            "meta" => [
                "href" => "$retail_result[0]" ,
                "type" => "retailshift" ,
                "mediaType" => "application/json" ,
            ]
        ] ,
        "positions" =>
            $position
        ,
        "sum" => (float) $evotor_arr[ 'closeResultSum' ] * 100 ,
        "cashSum" => $evotor_cash ,
        "noCashSum" => $evotor_no_cash ,
        "prepaymentCashSum" => 0.0 ,
        "prepaymentNoCashSum" => 0.0 ,
        "name" => "$name"
    ];


    $encode = json_encode ( $moysklad_arr );
    $urlapi = "https://online.moysklad.ru/api/remap/1.1/entity/retaildemand";
    $username = 'superviser@dmitriy12';
    $password = 'F1o55yi9';
    $ch = curl_init ();
    curl_setopt ( $ch , CURLOPT_URL , $urlapi );
    curl_setopt ( $ch , CURLOPT_RETURNTRANSFER , true );
    curl_setopt ( $ch , CURLOPT_USERPWD , "$username:$password" );
    curl_setopt ( $ch , CURLOPT_HTTPAUTH , CURLAUTH_BASIC );
    curl_setopt ( $ch , CURLOPT_HTTPHEADER , array ( 'Content-Type: application/json' ) );

    if ( $evotor_arr[ 'type' ] == 'SELL' ) {
//        curl_setopt ( $ch , CURLOPT_POST , 1 );
//        curl_setopt ( $ch , CURLOPT_POSTFIELDS , $encode );
    }
    $output = curl_exec ( $ch );
    curl_close ( $ch );

    file_put_contents ( 'testGetFromEvotor.json' , $output , FILE_APPEND );
    