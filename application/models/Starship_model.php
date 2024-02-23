<?php
class Starship_model extends CI_Model
{

  public $endpoint = 'https://swapi.dev/api/starships/';
  
  public function __construct() {
    $this->load->driver('cache', array('adapter' => 'file', 'backup' => 'file'));
  }

  public function get_by_id($id)
  {
    $cache_id = "starship_id_$id";

    if (!$response = $this->cache->get($cache_id)) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $this->endpoint . "$id/?format=json");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $response = curl_exec($ch);
      curl_close($ch);
      $this->cache->save($cache_id, $response, 86400);
    }

    return $response;
  }
}
