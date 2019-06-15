<?php

function authorizationBitrix() {
    global $bitrix_domain;
    global $bitrix_login;
    global $bitrix_password;
    global $bitrix_client_secret;
    global $bitrix_client_id;

    global $bitrix_redirect_uri;
    global $bitrix_scope;

    global $bitrix_token;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://www.bitrix24.net/auth/");
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "AUTH_FORM=Y&TYPE=AUTH&USER_LOGIN=" . $bitrix_login . "&USER_PASSWORD=" . $bitrix_password);

    curl_exec($ch);

    curl_setopt($ch, CURLOPT_URL, "https://" . $bitrix_domain . ".bitrix24.ru/oauth/authorize/?client_id=" .
        $bitrix_client_id . "&response_type=code&redirect_uri=" . $bitrix_redirect_uri);

    $subject = curl_exec($ch);

    $pattern = "#/?code=(.*)&domain#";

    preg_match($pattern, $subject, $matches);

    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_URL, "https://" . $bitrix_domain . ".bitrix24.ru/oauth/token/?client_id=" .
        $bitrix_client_id . "&grant_type=authorization_code&client_secret=" . $bitrix_client_secret .
        "&redirect_uri=" . $bitrix_redirect_uri . "&scope=" . $bitrix_scope . "&code=" . $matches[1]);

    $answer = curl_exec($ch);
    $jsonanswer = json_decode($answer);
    if (isset($jsonanswer->access_token)) {
        $bitrix_token = $jsonanswer->access_token;
        return true;
    } else {
        return false;
    }
}

function bitrixGetByID($bitrixName, $id) {
    global $bitrix_domain;
    global $bitrix_token;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_URL, "https://" . $bitrix_domain . ".bitrix24.ru/rest/crm.".$bitrixName.".get?auth=" . $bitrix_token);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "&id=$id");
    $result = curl_exec($ch);
    $jsonanswer = json_decode($result);
    return $jsonanswer;
}

function bitrixUpdateByID($bitrixName, $id, $fields) {
    global $bitrix_domain;
    global $bitrix_token;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_URL, "https://" . $bitrix_domain . ".bitrix24.ru/rest/crm.".$bitrixName.".update?auth=" . $bitrix_token);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "&id=$id&".
        http_build_query($fields));
    $result = curl_exec($ch);
    $jsonanswer = json_decode($result);
    return $jsonanswer;
}

function bitrixAdd($bitrixName, $fields) {
    global $bitrix_domain;
    global $bitrix_token;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_URL, "https://" . $bitrix_domain . ".bitrix24.ru/rest/crm.".$bitrixName.".add?auth=" . $bitrix_token);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "&".
        http_build_query($fields));
    $result = curl_exec($ch);
    $jsonanswer = json_decode($result);
    return $jsonanswer;
}

function bitrixGetList($bitrixName, $fields, $start = 0) {
    global $bitrix_domain;
    global $bitrix_token;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_URL, "https://" . $bitrix_domain . ".bitrix24.ru/rest/crm.".$bitrixName.".list?auth=" . $bitrix_token."&start=$start");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "&".
        http_build_query($fields));
    $result = curl_exec($ch);
    $jsonanswer = json_decode($result);
    return $jsonanswer;
}

function bxAuth() {
    global $bitrix_domain;
    global $bitrix_login;
    global $bitrix_password;
    global $bitrix_client_secret;
    global $bitrix_client_id;
    global $bitrix_redirect_uri;
    global $bitrix_scope;
    global $bitrix_token;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.bitrix24.net/auth/");
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "AUTH_FORM=Y&TYPE=AUTH&USER_LOGIN=".$bitrix_login."&USER_PASSWORD=".$bitrix_password);
    curl_exec($ch);

    curl_setopt($ch, CURLOPT_URL, "https://" . $bitrix_domain . ".bitrix24.ru/oauth/authorize/?client_id=" .
        $bitrix_client_id . "&response_type=code&redirect_uri=" . $bitrix_redirect_uri);

    $subject = curl_exec($ch);

    $pattern = "#/?code=(.*)&domain#";

    preg_match($pattern, $subject, $matches);

    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_URL, "https://" . $bitrix_domain . ".bitrix24.ru/oauth/token/?client_id=" .
        $bitrix_client_id . "&grant_type=authorization_code&client_secret=" . $bitrix_client_secret .
        "&redirect_uri=" . $bitrix_redirect_uri . "&scope=" . $bitrix_scope . "&code=" . $matches[1]);

    $answer = curl_exec($ch);
    $jsonanswer = json_decode($answer);
    if (isset($jsonanswer->access_token)) {
        $bitrix_token = $jsonanswer->access_token;
        return true;
    } else {
        return false;
    }
}

function bxRequest($requestBody, $data = []) {
    global $bitrix_domain;
    global $bitrix_token;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_URL, "https://".$bitrix_domain.".bitrix24.ru/rest/".$requestBody."?auth=".$bitrix_token);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "&".http_build_query($data));
    $result = curl_exec($ch);
    $jsonanswer = json_decode($result);
    return $jsonanswer;
}

function bxGetById() {}
