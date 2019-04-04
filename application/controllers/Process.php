<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process extends CI_Controller {

	public function index($url = "")
	{
        $short = $this->short->generate($url);
        if($this->short->put($url, $short)){
            $res = ['status' => 0, 'short' => $short];
        } else {
            $res = ['status'=> -1, 'short' => ''];
        }
        echo json_encode($res);
	}
}
