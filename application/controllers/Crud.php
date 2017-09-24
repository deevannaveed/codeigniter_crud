<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('task_model');
	}

	public function index()
	{
		$data['tasks'] = $this->task_model->get_tasks();
		$this->load->view('index', $data);
	}

	public function create_task(){
		$this->task_model->create_task();
	}

	public function update_task(){
		$this->task_model->update_task();
	}

	public function delete_task(){
		$this->task_model->delete_task();
	}
}
