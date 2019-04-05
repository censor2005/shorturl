<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stat extends CI_Controller {

	public function show($short_id = false)
	{
		if($this->short->getById($short_id)){
			$result = $this->short->getById($short_id);
            /*$stats = $this->db
                ->where('short_id', $result->short_id)
                ->get('stats')
                ->result();*/
            $total_hits = $this->db
                ->where('short_id', $result->id)
                ->count_all('stats');
            $by_browser = $this->db
                ->select('count(*) as cnt, browser')
                ->where('short_id', $result->id)
                ->group_by('browser')
                ->get('stats')
                ->result();
            $by_platform = $this->db
                ->select('count(*) as cnt, platform')
                ->where('short_id', $result->id)
                ->group_by('platform')
                ->get('stats')
                ->result();
            $this->data['total_hits'] = $total_hits;
            $this->data['by_browser'] = $by_browser;
            $this->data['by_platform'] = $by_platform;
            $this->load->view('stats', $this->data);
		}
	}
}
