<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process extends CI_Controller {

	public function index()
	{
        $url = urldecode($this->input->post('url'));
        if(strlen($url) == 0){
            $res = ['status'=> -1, 'short' => ''];
            echo json_encode($res);
            die();
        }
        $expire = $this->input->post('expire');
        switch($expire){
            case '0':
                $expire_date = time() + 10*365*24*60*60;
            break;
            case 'year':
                $expire_date = time() + 365*24*60*60;
            break;
            case 'month':
                $expire_date = time() + 31*24*60*60;
            break;
            case 'day':
                $expire_date = time() + 24*60*60;
            break;
            case 'hour':
                $expire_date = time() + 60*60;
            break;
        }
        $short = $this->short->generate($url);
        if($this->short->put($url, $short, $expire_date)){
            $short_info = $this->short->getByShort($short);
            $res = ['status' => 0, 'short' => $short, 'url' => $url, 'id' => $short_info->id];
        } else {
            $res = ['status'=> -1, 'short' => ''];
        }
        echo json_encode($res);
	}
}
