<?php class Short extends CI_Model {
    
    private $letters = "abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
    
    public function generate($url = "", $len = false){
        $max = strlen($this->letters)-1;
        if ($len === false){
            $total_count = $this->db->count_all('shorts');
            // считаем, что если мы исчерпали 1% диапазона, то его пора расширять
            
            if($total_count < 23){ // двухсимвольные исчерпаны
                $len = 3;
            } else if($total_count < 1105){ //трехсимвольные исчерпаны на 1%
                $len = 4;
            } else if($total_count < 53084){ //четырехсимвольные исчерпаны на 1%
                $len = 5;
            } else if($total_count < 2548039){ //пятисимвольные исчерпаны на 1%
                $len = 6;
            } else if($total_count < 122305904){ //шестисимвольные исчерпаны на 1%
                $len = 7;
            } else { //восмисимвольные == 12.230.590.464 (12 млрд), достигнем ли такого количества?
                $len = 8;
            }
        }
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
        $count = $this->db->where('short', $short)->count_all_results('shorts');
        $exists = $count > 0 || strtolower($short) == 'process' || strtolower($short) == 'welcome';
        return $exists;
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