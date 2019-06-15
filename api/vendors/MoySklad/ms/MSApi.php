<?php
/**
 * Copyright Maxim Bykovskiy © 2018.
 */

require_once 'abstractCurl.php';
require_once 'interMs.php';

class MSApi extends CurlCon implements MoiSklad {
    private $userAc;
    private $passAc;
    private $urlApi = 'https://online.moysklad.ru/api/remap/1.1';

    public function __construct($user, $pass){
        $this->userAc = $user;
        $this->passAc = $pass;
        CurlCon::setUserPWD("$this->userAc:$this->passAc");
    }

    public function getStore(){
        return json_decode(CurlCon::getCurl($this->urlApi.'/entity/store'));
    }

    public function methodCreate($type, $param=[]){
        return json_decode(CurlCon::postCurl($this->urlApi.'/entity/'.$type, json_encode($param)));
    }

    public function methodUpdate($type, $id, $param=[]){
        return json_decode(CurlCon::putCurl($this->urlApi.'/entity/'.$type.'/'.$id, json_encode($param)));
    }

    public function methodUpdateByHref($url, $param=[]){
        return json_decode(CurlCon::putCurl($url, json_encode($param)));
    }

    public function methodPreCreate($type, $param=[]){
        return json_decode(CurlCon::putCurl($this->urlApi.'/entity/'.$type, json_encode($param)));
    }

    public function methodDelete($type, $id, $param=[]){
        return json_decode(CurlCon::deleteCurl($this->urlApi.'/entity/'.$type.'/'.$id));
    }

    public function methodDeleteByHref($type){
        return json_decode(CurlCon::deleteCurl($type));
    }

    public function getList($type, $offset = 0, $limit = 25, $update = '', $search = '', $idStore = ''){
        $param = [
            'limit' => $limit,
            'offset' => $offset
        ];
        if(!empty($search))
            $param['search'] = $search;
        if(!empty($idStore)) {
            $param['store.id'] = $idStore;
        }
//        if(!empty($update)){
//            $param['filter']['updated'] = $update;
//        }
//        print_r($param);
        return json_decode(CurlCon::getCurl($this->urlApi.'/entity/'.$type.((count($param)<0)? '' : '?'.http_build_query($param) . (!empty($update) ? "&filter=updated" . urlencode(">" . $update) : ""))));
    }

    public function getStocks($offset = 0, $limit = 25, $id = ''){
        ini_set('date.timezone', 'Europe/Moscow');
        $param = [
            'limit' => $limit,
            'offset' => $offset,
            'groupBy' => 'product',
            'stockMode' => 'all'
            //'moment' => date("Y-m-d H-i-s")
        ];
        if(!empty($id))
            $param['product.id'] = $id;
        return json_decode(CurlCon::getCurl($this->urlApi.'/report/stock/all'.((count($param)<0)? '' : '?'.http_build_query($param))));
    }

    public function getOne($type, $id){
        return json_decode(CurlCon::getCurl($this->urlApi.'/entity/'.$type.'/'.$id));
    }

    public function getInfo($url){
        return json_decode(CurlCon::getCurl($url));
    }

    public function getProducts($offset = 0, $limit = 25, $idStore = ''){
        $param = [
            'limit' => $limit,
            'offset' => $offset
        ];
        if(!empty($idStore)){
            $param['store.id'] = $idStore;
        }
        return json_decode(CurlCon::getCurl($this->urlApi.'/entity/product'.((count($param)<0)? '' : '?'.http_build_query($param))));
    }

    public function getCounterparty($offset = 0, $limit = 25, $idStore = ''){
        $param = [
            'limit' => $limit,
            'offset' => $offset
        ];
        if(!empty($idStore)){
            $param['store.id'] = $idStore;
        }
        return json_decode(CurlCon::getCurl($this->urlApi.'/entity/counterparty'.((count($param)<0)? '' : '?'.http_build_query($param))));
    }

    public function getAssortment($offset = 0, $limit = 25, $idStore = '', $scope = 'variant', $otherParam = []){
        $param = [
            'limit' => $limit,
            'offset' => $offset,
            'scope' => $scope
        ];
        if(!empty($idStore)){
            $param['store.id'] = $idStore;
        }
        if(count($otherParam) > 0){
            foreach ($otherParam as $key => $par){
                if($key == 'search'){
                    $param['filter='.$key] = $par;
                } else {
                    $param[$key] = $par;
                }
            }
        }
        return json_decode(CurlCon::getCurl($this->urlApi.'/entity/assortment'.((count($param)<0)? '' : '?'.http_build_query($param))));
    }
}