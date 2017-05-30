<?php

/**
 * Wrapper class to BTC-e exchange public API.
 * 
 * @author novardanak
 * @license MIT License - https://github.com/novardanak/PHP-btce-public-api-client
 */
class BTCePublicApiClient
{
    private $method;
    private $pairs;
    
    const AVAILABLE_METHODS = array('info','ticker','depth','trades');
    
    public function __construct($method,$pairs)
    {
        $this->setMethod($method);
        $this->setPairs($pairs);
    }
    
    private function setMethod($method)
    {
        $trimmed = trim($method);
        $lowered = strtolower($trimmed);
        if (in_array($lowered,self::AVAILABLE_METHODS)){
            $this->method = $method;
        } else {
            throw new \Exception('Not existent API method.');
        }
    }
    
    private function setPairs($pairs){
        if ($pairs !== false) {
            if (is_array($pairs)) {
                $a = array();
                foreach ($pairs as $pair){
                    if (preg_match('/\D{3}_\D{3}\b/',$pair)){
                        if (!in_array($pair, $a)){
                            array_push($a,$pair);
                        } else {
                            throw new Exception('$pairs contained duplicate value.');
                        }
                    } else {
                        throw new Exception('$pairs contained malformed pair.');
                    }
                }
                $this->pairs = $a;
            } else {
                throw new Exception('$pairs parameter must be an array with flat structure.');
            }
        } else {
            $this->pairs = false;
        }
    }
   
    public function send()
    {   
        $url = "https://btc-e.com/api/3/";
        $url .= $this->method;
        if ($this->pairs != false){
            $url .= '/';
            $url .= implode('-',$this->pairs);
        }        
        $url .= '?ignote_invalid=1';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        $data = curl_exec($curl);        
        curl_close($curl);
        return json_decode($data);
    }        
}

?>