<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');               // provides set_value(), form_open(), etc.
        $this->load->helper('url');                // provides redirect(), site_url()
        $this->load->library('form_validation');   // provides validation rules and validation_errors()
        $this->load->library('session');           // for flashdata
    }

    public function index()
    {
        $this->load->view('contact');
    }

    public function send()
    {
        // Only accept POST
        if ($this->input->method() !== 'post') {
            show_error('Invalid request method', 405);
            return;
        }

        // Validation rules
        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('message', 'Message', 'trim|required|min_length[10]');

        if ($this->form_validation->run() === FALSE) {
            // validation failed -> re-display form with errors and old input
            $this->load->view('contact');
            return;
        }

        // Process valid submission
        // Option A: send an email (example)
        $this->load->library('email');
        $this->email->from($this->input->post('email'), $this->input->post('name'));
        $this->email->to('sgtm3tasem@gmail.com'); // change to your destination
        $this->email->subject('Contact form message');
        $this->email->message($this->input->post('message'));

        if ($this->email->send()) {
            $this->session->set_flashdata('success', 'Thanks — your message was sent.');
        } else {
            // If email fails, you can log or save to DB instead
            $this->session->set_flashdata('success', 'Could not send message. Please try again later.');
        }

        // Redirect to avoid form resubmission
        redirect('contact');
    }
}
