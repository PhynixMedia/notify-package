<?php

namespace Notify\App\Services\Fcm;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Phynixmedia\Mailer\Exceptions\UnableToSendMailException;

class FCMRequest
{
    protected $header;

    protected $client;

    public function __construct(){

        $this->header = self::header();
        $this->client = new Client();

    }

    /**
     * @return string[]
     */
    private static function header(){

        $key = config("notify-app.sender_id");

        return [
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
            'Authorization' => "key={$key}"
        ];
    }

    /**
     * @param string $to
     * @param string $title
     * @param string $message
     * @return array
     */
    public static function payload(string $to, string $title, string $message ){

        return [
            "to"           => $to,
            "notification" => [
                "title" => env("APP_NAME") ?? "Anonymous",
                "body"  => $message
            ],
            "apns" => [
                "payload"  => [
                    "aps" => [
                        "sound" => 'default',
                        "badge" => "2"
                    ]
                ],
                "headers" => [
                    "apns-priority" => "10"
                ],
//                    "payload" => [
//                        "aps" => [
//                            "alert" => [
//                                "title" => env("APP_NAME"),
//                                "body"  => $message
//                            ],
//                        "badge" => 2,
//                        "sound" => "default"
//                    ]
//                ]
            ]
        ];
    }

    /**
     * @param array $payload
     * @throws UnableToSendMailException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(array $payload){

        try {

            $path = "https://fcm.googleapis.com/fcm/send";
            $response = $this->push($path, self::header(), $payload);

            \Log::error("FCMService Send Success " . json_encode($response));

            return true;

        } catch (GuzzleException $e) {

            \Log::error("FCMService Send Failed " . $e->getMessage());
            return false;
        }
    }

    /**
     * @param $path
     * @param array $header
     * @param array $payload
     * @return string
     * @throws UnableToSendMailException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function push($path, array $header, array $payload){

        try
        {
            $response = $this->client->post($path,
                [
                    "headers" => $header,
                    "body" => json_encode($payload, true)
                ]);
            return $response->getBody()->getContents();

        }catch(\GuzzleHttp\Exception\ClientException $e)
        {
            throw new UnableToSendMailException($e->getResponse());
        }catch(\GuzzleHttp\Exception\ConnectException $e)
        {
            throw new UnableToSendMailException($e->getResponse());
        }
    }
}