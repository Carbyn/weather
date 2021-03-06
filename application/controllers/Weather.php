<?php
class WeatherController extends Yaf\Controller_Abstract {

	public function getAction() {
		$longitude = $this->getRequest()->getQuery("longitude");
		$latitude = $this->getRequest()->getQuery("latitude");

		$location = \Explorer\Lbsyun::geocoder($longitude, $latitude);
		$weather = \Explorer\Lbsyun::fetch($location);
		$weather['location'] = $location;
		$weather['tips'] = '你丫不用穿了，裸奔吧！';
		$weather['timestamp'] = time();
		$weather['is_night'] = date('H') > 18 ? 1 : 0;
		$data['status'] = empty($weather['day2_weather']) ? -1 : 0;
		$data['weather'] = $weather;

		header('Content-Type: application/json');
		echo json_encode($data);
	}

}
