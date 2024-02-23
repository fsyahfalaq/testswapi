<?php
class Person_model extends CI_Model
{

  public $endpoint = 'https://swapi.dev/api/people/';

  public function __construct() {
    $this->load->driver('cache', array('adapter' => 'file', 'backup' => 'file'));
  }

  public function get_all($page = 1)
  {
    $cache_id = "person_get_all_$page";

    if (!$response = $this->cache->get($cache_id)) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $this->endpoint . "?format=json&page=$page");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $response = curl_exec($ch);
      curl_close($ch);
      $this->cache->save($cache_id, $response, 86400);
    }

    return $response;
  }

  public function get_by_name($page, $name)
  {
    $clean_space_name = str_replace(' ', '%20', $name);
    $cache_id = "person_get_name_{$name}_{$page}";

    if (!$response = $this->cache->get($cache_id)) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $this->endpoint . "?format=json&page=$page&search=$clean_space_name");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $response = curl_exec($ch);
      curl_close($ch);
      $this->cache->save($cache_id, $response, 86400);
    }

    return $response;
  }
}
