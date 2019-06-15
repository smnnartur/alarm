<?php
/**
 * Copyright Maxim Bykovskiy © 2018.
 */

interface MoiSklad {
    public function __construct($user, $pass);

    public function getStore();

    public function methodCreate($type, $param);

    public function methodUpdate($type, $id, $param);

    public function methodDelete($type, $id, $param);

    public function getList($type, $offset, $limit, $idStore);

    public function getOne($type, $id);

    public function getProducts($offset, $limit, $idStore);

    public function getCounterparty($offset, $limit, $idStore);

    public function getAssortment($offset, $limit, $idStore, $scope, $otherParam);

    public function getInfo($url);
}