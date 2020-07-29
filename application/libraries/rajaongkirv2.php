<?php

/**
 * RajaOngkir CodeIgniter Library
 * Digunakan untuk mengkonsumsi API RajaOngkir dengan mudah
 * 
 * @author Damar Riyadi <damar@tahutek.net>
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'RajaOngkir/endpoints.php';

class RajaOngkirv2 extends Endpoints {

    private $api_key;
    private $account_type;

    public function __construct() {
        // Pastikan bahwa PHP mendukung cURL
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=12",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 7ce7425edc117427abb39cb21e69e456"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return $response;
    }
}
