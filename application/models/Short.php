<?php class Short extends CI_Model {
    
    private $letters = "abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
    
    public function generate($url = "", $len = 6){
        $max = strlen($this->letters)-1;
        
        do{
            $short = "";
            for($i = 0; $i < $len; $i++){
                $short .= $this->letters[rand(0,$max)];
            }
        } while($this->exists($short));
        
        return $short;
    }

    /**
     * @param string url to convert
     * @param string short url
     * @return boolean
     */
    public function put($url, $short){
        $insert = [
            'url' => trim($url),
            'short' => $short,
        ];
        return $this->db->insert('shorts', $insert);
    }

    public function exists($short = ""){
        return $this->db->where('short', $short)->count_all_results('shorts') > 0;
    }
/**
 * funtion to get data as object by short url
 * returns object
 */

    public function getByShort($short = ""){
        return $this->db->where('short', $short)->get('shorts')->row();
    }

/**
 * funtion to get data as object by full url
 * returns object if exists, false otherwise
 */
    public function getByUrl($url = ""){

    }
}