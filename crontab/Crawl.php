<?php
define('APPLICATION_PATH', dirname(__FILE__).'/..');

require_once(APPLICATION_PATH.'/vendor/autoload.php');

$application = new Yaf\Application(APPLICATION_PATH . "/conf/application.ini");

$application->execute("main");

function main() {
    $cities = \Explorer\City::getCities();
    if (empty($cities)) {
        echo "cities is empty\n";
        return;
    }
    foreach($cities as $city) {
        \Explorer\Lbsyun::weather($city);
    }
    echo "All done!\n";
}
