<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redirect extends CI_Controller {

	public function to($short = "")
	{
		if($this->short->exists($short)){
			$result = $this->short->getByShort($short);
			$full_url = $result->url;
			redirect($full_url);
		}
	}
}
