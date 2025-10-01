<?php
defined("BASEPATH") or die("No direct script access allowed");

class Test extends CI_Controller
{
    public function index()
    {
        echo "Hello, World!<br/>";
        $this->load->view('test');
    }
}