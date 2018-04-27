<?php
namespace Explorer;
class City {
    
    private static $cities;
    
    public static function getCities() {
        if (self::$cities) {
            return self::$cities;
        }
        $json_path = APPLICATION_PATH.'/application/library/Explorer/cities.json';
        if (!@file_exists($json_path)) {
            return false;
        }
        $data = json_decode(file_get_contents($json_path), true);
        foreach($data as $prov) {
            foreach($prov['cities'] as $city) {
                self::$cities[] = preg_replace('/市$/', '', $city['name']);
            }
        }
        return self::$cities;
    }

}
