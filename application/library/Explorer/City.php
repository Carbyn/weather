<?php
/*
 * cities came from http://lbsyun.baidu.com/index.php?title=webapi/guide/webservice-geocoding-abroad
 */
namespace Explorer;
class City {
    
    private static $cities;
    
    public static function getCities() {
        if (self::$cities) {
            return self::$cities;
        }
        $cities_path = APPLICATION_PATH.'/application/library/Explorer/cities.txt';
        if (!@file_exists($cities_path)) {
            return false;
        }
        $data = file_get_contents($cities_path);
        $data = explode("\n", trim($data));
        foreach($data as $city) {
            self::$cities[] = preg_replace('/市$/', '', $city);
        }
        return self::$cities;
    }

}
