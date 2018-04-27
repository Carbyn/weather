<?php
class StickerController extends Yaf\Controller_Abstract {

	public function convertAction() {
		header('Content-Type: application/json');

	    $name = $this->getRequest()->getPost('name');
	    if (empty($name)) {
	        echo json_encode(['status' => -1]);
	        return;
	    }

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

        if ($file['error'] == 0 && !empty($file['name'])) {
            move_uploaded_file($file['tmp_name'], $upload_path.'/'.$file['name']);
        } else {
            echo json_encode(['status' => -3]);
            return;
        }

        $gif_name = uniqid(true).'.gif';
        $cmd = sprintf('/usr/bin/convert %s -size 320 %s', $upload_path.'/'.$file['name'], $static_path.'/'.$gif_name);
        exec($cmd, $out);
        $image_url = 'https://weather.1024.pm/static/'.$gif_name;
        echo json_encode(['status' => 0, 'image' => $image_url]);
	}

}
