<?php
class StickerController extends Yaf\Controller_Abstract {

	public function convertAction() {
		header('Content-Type: application/json');

	    $name = 'image';

	    $upload_path = APPLICATION_PATH.'/uploads';
	    if (!@file_exists($upload_path)) {
	        mkdir($upload_path);
	    }
	    $static_path = APPLICATION_PATH.'/static';
	    if (!@file_exists($static_path)) {
	        @mkdir($static_path);
	    }

	    $files= $this->getRequest()->getFiles();
	    if (empty($files[$name])) {
	        echo json_encode(['status' => -2]);
	        return;
	    }

        $file = $files[$name];

        $img_name = uniqid(true);
        if ($file['error'] == 0 && !empty($file['name'])) {
            move_uploaded_file($file['tmp_name'], $upload_path.'/'.$img_name);
        } else {
            echo json_encode(['status' => -3]);
            return;
        }

        $gif_name = $img_name.'.gif';
        $cmd = sprintf('/usr/bin/convert %s -resize 320x %s', $upload_path.'/'.$img_name, $static_path.'/'.$gif_name);
        exec($cmd, $out);
        $image_url = 'https://weather.1024.pm/static/'.$gif_name;
        echo json_encode(['status' => 0, 'image' => $image_url]);
	}

}
