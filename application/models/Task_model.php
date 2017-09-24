<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model {

        public $name;
        public $description;
        public $date_created;
        public $date_updated;

        public function get_tasks()
        {
                $query = $this->db->get('tasks');
                return $query->result();
        }

        public function create_task()
        {
                $json = array();
                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_rules('description', 'Description', 'required');
                if($this->form_validation->run()){
                        $this->name            = $this->input->post('name'); // please read the below note
                        $this->description          = $this->input->post('description');
                        $res = $this->db->insert('tasks', $this);
                        if($res){
                                $insert_id = $this->db->insert_id(); 
                                $json = array(
                                        'type' => 'success',
                                        'message' => $this->db->get_where('tasks', ['id' => $insert_id])->row_array()
                                );
                        } else {
                                $json = array(
                                        'type' => 'error',
                                        'message' => 'Sorry! Cannot Insert the Task'
                                );
                        }
                } else{
                        $json = array(
                                'type' => 'error',
                                'message' => validation_errors()
                        );
                }
                header('Content-Type: application/json');
                echo json_encode($json);
        }

        public function update_task()
        {
                $json = array();
                $this->form_validation->set_rules('task_id', 'ID', 'required');
                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_rules('description', 'Description', 'required');
                if($this->form_validation->run()){
                        $id                    = $this->input->post('task_id');
                        $data['name']          = $this->input->post('name');
                        $data['description']   = $this->input->post('description');
 //                       $data['date_updated']  = time();
                        $update_id = $this->db->update('tasks', $data, array('id' => $id));
                        if($update_id){
                                $json = array(
                                        'type' => 'success',
                                        'message' => $this->db->get_where('tasks', ['id' => $id])->row_array()
                                );
                        } else {
                                $json = array(
                                        'type' => 'error',
                                        'message' => 'Sorry! Cannot Update the Task'
                                );
                        }
                } else{
                        $json = array(
                                'type' => 'error',
                                'message' => validation_errors()
                        );
                }
                header('Content-Type: application/json');
                echo json_encode($json);
        }

        public function delete_task(){
                $json = array();
                $id = $this->input->post('id');
                if($id > 0){
                        $res = $this->db->delete('tasks', ['id' => $id]);
                        if($res != FALSE){
                                $json = array(
                                        'type' => 'success',
                                        'message' => 'Task Deleted Successfully'
                                );   
                        } else {
                                $json = array(
                                        'type' => 'error',
                                        'message' => 'Sorry! Cannot Delete the Task'
                                );                                  
                        }    
                } else{
                        $json = array(
                                'type' => 'error',
                                'message' => 'Invalid ID'
                        );   
                }
                header('Content-Type: application/json');
                echo json_encode($json);
        }

}