<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Person extends CI_Controller
{

  public function index()
  {
    $this->load->view('index');
  }

  public function ajax_get()
  {
    $this->load->model(['person_model', 'starship_model', 'planet_model']);
    $current_page = ($this->input->get('start') + $this->input->get('length')) / 10;
    $search_query = $this->input->get('search');
    
    $data = [];
    if (!empty($search_query['value'])) {
      $data = json_decode($this->person_model->get_by_name($current_page, $search_query['value']));
    } else {
      $data = json_decode($this->person_model->get_all($current_page));
    }

    $data_persons = [];
    $no = $this->input->get('start');
    foreach ($data->results as $person) {
      $data_person = [];
      $data_person['no'] = ++$no;
      $data_person['name'] = $person->name;
      $data_person['gender'] = $person->gender;

      // get homerworld
      $homeworld_id = retrieve_id_from_link($person->homeworld);
      $homeworld = json_decode($this->planet_model->get_by_id($homeworld_id));

      $data_person['homeworld'] = '<a href="#" data-toggle="modal" data-target="#planetModal" data-id="'. $homeworld_id .'">'. $homeworld->name  .'</a>';

      // get starships
      $starships = [];
      foreach ($person->starships as $starship) {
        $starship_id = retrieve_id_from_link($starship);
        $starship = json_decode($this->starship_model->get_by_id($starship_id));
        if (!empty($starship)) {
          $starships[] = "$starship->name ($starship->model)";
        }
        
        $data_person['starship'] = $starships;
      }
      
      $data_persons[] = $data_person;
    }

    $data->draw = $this->input->get('draw');
    $data->data = $data_persons;
    $data->recordsTotal = $data->count;
    $data->recordsFiltered = $data->count;

    echo json_encode($data);
  }
}
