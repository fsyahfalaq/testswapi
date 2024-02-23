<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Planet extends CI_Controller
{

  public function get_by_id()
  {
    $this->load->model(['planet_model']);
    $planet_id = $this->input->get('id');
    $planet = $this->planet_model->get_by_id($planet_id);
    
    echo $planet;
  }
}