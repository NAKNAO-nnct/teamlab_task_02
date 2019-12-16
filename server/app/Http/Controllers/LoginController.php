<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller {
    //

    public function getLineUserProfile() {

        $postData = array(
            'grant_type' => 'authorization_code',
            'code' => $_GET['code'],
            'redirect_uri' => 'https://misosiru.ml/callback.php',
            'client_id' => '1653607210',
            'client_secret' => 'a4d915c1d2b983f30a726f40370ba742'
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_URL, 'https://api.line.me/v2/oauth/accessToken');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);


        $json = json_decode($response);
        $accessToken = $json->access_token;


        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $accessToken));
        curl_setopt($ch, CURLOPT_URL, 'https://api.line.me/v2/profile');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($response);

        $json = json_decode(json_encode($json), true);
        print_r($json);

//        echo $json['userId'];
    }
}
