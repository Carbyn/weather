<?php
class WeatherController extends Yaf\Controller_Abstract {

	public function getAction() {
		$longitude = $this->getRequest()->getQuery("longitude");
		$latitude = $this->getRequest()->getQuery("latitude");

		$location = \Explorer\Lbsyun::geocoder($longitude, $latitude);
		$weather = \Explorer\Lbsyun::fetch($location);
		$weather['tips'] = '你丫不用穿了，裸奔吧！';

		header('Content-Type: application/json');
		echo json_encode($weather);
	}

}
