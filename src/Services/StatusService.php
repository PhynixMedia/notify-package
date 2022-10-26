<?php

namespace Notify\App\Services;

class StatusService
{

    public static function success($key, $data = null)
    {
        return [
            "data" => self::data_type($data) ? $data : [],
            "status"    => "success",
            "message"   => ucfirst($key) . " request successfully completed",
        ];
    }

    public static function error($key, $data = null)
    {
        return [
            "data" => self::data_type($data) ? $data : [],
            "status"    => "danger",
            "message"   => "Unable to complete " . ucfirst($key) . " request",
        ];
    }

    public static function status_with_message(string $status, string $message, $data = null)
    {
        return [
            "data" => self::data_type($data) ? $data : [],
            "status"    => $status,
            "message"   => $message
        ];
    }

    public static function info($message,  $data = null)
    {
        return [
            "data" => self::data_type($data) ? $data : [],
            "status"    => "info",
            "message"   => $message,
        ];
    }

    public static function error_with_message($message,  $data = null)
    {
        return [
            "data"      => self::data_type($data) ? $data : [],
            "status"    => "danger",
            "message"   => $message
        ];
    }

    public static function with_message($message,  $data = null, $status = "success")
    {
        return [
            "data"      =>  $data,
            "status"    => $status,
            "message"   => $message
        ];
    }

    public static function warning($message, $data = null)
    {
        return [
            "data" => self::data_type($data) ? $data : [],
            "status"    => "info",
            "message"   => self::data_type($data) ? $data : "Warning :: " . $message,
        ];
    }

    private static function data_type($data){

        if(is_array($data)){
            return true;
        }
        return false;
    }

}
