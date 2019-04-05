<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redirect extends CI_Controller {

	public function to($short = "")
	{
		if($this->short->exists($short)){

			$result = $this->short->getByShort($short);
			
			if($result->expire < date('Y-m-d H:i:s')){
				die('link not found');
			}
			$this->load->library('user_agent');
			
			$insert = [
				'short_id' => $result->id,
				'user_agent' => $this->agent->agent_string(),
				'browser' => $this->agent->browser(),
				'version' => $this->agent->version(),
				'platform' => $this->agent->platform(),
			];
			$this->db->insert('stats', $insert);
			$full_url = $result->url;
			
			redirect($full_url);
		}
	}
}
