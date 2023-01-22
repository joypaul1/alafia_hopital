<?php

namespace App\Traits;

use App\SMS as AppSMS;
use GuzzleHttp\Client;

trait SMS
{
    public static function sendSMS($mobile_no, $text)
    {
        // $otp_config =  AppSMS::first();
        // $url = 'https://bulksms.ahmedtechbd.com/smsapi/sendsms?apikey='.':apiKey'.'&smstype='.':smsType'.'&msisdn='.':MOBILE'.'&senderid='.':senderId'.'&msg='.':TEXT';
       
        $url = 'http://103.84.172.18/api/v2/SendSMS?ApiKey={:apiKey}&ClientId={:clientId}&SenderId={:senderId}&Message={:messageId}&MobileNumbers={:mobileNumbers}&Is_Unicode={:is_Unicode}&Is_Flash={:is_Flash}';
        
        $url = str_replace(':apiKey',  'ZEcnqEaeNZSaielJlBQR/GJte4eR1AMBYvCCyh9hn1o=', $url);
        $url = str_replace(':clientId',  '5ae7a100-f4b4-41d4-9c05-c72bcaac5e19', $url);
        $url = str_replace(':senderId',  '8804445602057', $url);
        $url = str_replace(':messageId',  'আমি নাই', $url);
        $url = str_replace(':mobileNumbers',  '8801705102555', $url);
        $url = str_replace(':is_Unicode',  'true', $url);
        $url = str_replace(':is_Flash',  'true', $url);
                // 'SenderId': '8804445602057',
                // 'ApiKey': 'ZEcnqEaeNZSaielJlBQR/GJte4eR1AMBYvCCyh9hn1o=',
                // 'ClientId': '5ae7a100-f4b4-41d4-9c05-c72bcaac5e19',
                // 'Message': 'আমি তমালে নাই',
                // 'MobileNumbers': '8801705102555,8801705102555'
        // return $url;
        try {
            return (new Client)->get($url)->getBody();
        } catch (\Exception $e) {
            return ['sms'=> $e->getMessage(), 'url'=>$url  ];
        }
    }


}