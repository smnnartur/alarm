<?php
/**
 * Copyright Maxim Bykovskiy © 2018.
 */

abstract class CurlCon {
    public function setOtherHeader($Auth) {
        if(is_array($Auth)) {
            $this->header = $Auth;
        } else {
            $this->header = [$Auth];
        }
    }

    public function setUserPWD($userAndPwd)
    {
        $this->userPWD = $userAndPwd;
    }

    protected function postCurl($url, $postData){
        $curl=curl_init();
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru-RU; rv:1.7.12) Gecko/20050919 Firefox/1.0.7');
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
        curl_setopt($curl,CURLOPT_POSTFIELDS, $postData);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        if(isset($this->userPWD)) {
            curl_setopt($curl, CURLOPT_USERPWD, $this->userPWD);
        }
        curl_setopt($curl,CURLOPT_HEADER,false);
        curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt');
        curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt');
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
        try {
            $out = curl_exec($curl);
            curl_close($curl);
            return $out;
        } catch (Exception $e){
            return 'Ошибка соединения: '.$e;
        }
    }

    protected function getCurl($url, $header = false){
//        print_r($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        if ($header == true){
            curl_setopt($ch, CURLOPT_HEADER, TRUE);
        }
        if(isset($this->header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
        }
        if(isset($this->userPWD)) {
            curl_setopt($ch, CURLOPT_USERPWD, "$this->userPWD");
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_COOKIEJAR,  __DIR__ . "/cookie.txt");
        curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . "/cookie.txt");
        try {
            $res = curl_exec($ch);
            curl_close($ch);
            return $res;
        } catch (Exception $e){
            return 'Ошибка соединения: '.$e;
        }
    }

    protected function putCurl($url, $postData, $header = false){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if ($header == true){
            curl_setopt($ch, CURLOPT_HEADER, TRUE);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch,CURLOPT_USERAGENT , "Mozilla/5.0 (Windows; U; Windows NT 5.1; ru-RU; rv:1.7.12) Gecko/20050919 Firefox/1.0.7");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        if(isset($this->userPWD)) {
            curl_setopt($ch, CURLOPT_USERPWD, "$this->userPWD");
        }
        curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . "/cookie.txt");
        curl_setopt($ch, CURLOPT_COOKIEFILE,  __DIR__ . "/cookie.txt");
        $out = curl_exec($ch);
        curl_close($ch);
        return $out;
    }

    protected function deleteCurl($url, $header = false){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if ($header == true){
            curl_setopt($ch, CURLOPT_HEADER, TRUE);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch,CURLOPT_USERAGENT , "Mozilla/5.0 (Windows; U; Windows NT 5.1; ru-RU; rv:1.7.12) Gecko/20050919 Firefox/1.0.7");
        if(isset($this->header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
        }
        if(isset($this->userPWD)) {
            curl_setopt($ch, CURLOPT_USERPWD, "$this->userPWD");
        }
        curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . "/cookie.txt");
        curl_setopt($ch, CURLOPT_COOKIEFILE,  __DIR__ . "/cookie.txt");
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }
}