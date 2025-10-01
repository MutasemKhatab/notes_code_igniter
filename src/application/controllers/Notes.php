<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notes extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('note_model');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index() {
        $data['notes'] = $this->note_model->get_notes();
        $data['title'] = 'Notes';
        $this->load->view('notes/index', $data);
    }

    public function create() {
        if($this->input->post('title')) {
            $note_data = array(
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
            );
            $this->note_model->create_note($note_data);
            redirect('notes');
        }
        $data['title'] = 'Create Note';
        $this->load->view('notes/create', $data);
    }

    public function view($id) {
        $data['note'] = $this->note_model->get_note_by_id($id);
        if(!$data['note']) {
            show_404();
        }
        $data['title'] = 'View Note';
        $this->load->view('notes/view', $data);
    }

    public function edit($id) {
        $data['note'] = $this->note_model->get_note_by_id($id);
        if(!$data['note']) {
            show_404();
        }
        
        if($this->input->post('title')) {
            $note_data = array(
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
            );
            $this->note_model->update_note($id, $note_data);
            redirect('notes');
        }
        
        $data['title'] = 'Edit Note';
        $this->load->view('notes/edit', $data);
    }

    public function delete($id) {
        $this->note_model->delete_note($id);
        redirect('notes');
    }
}
