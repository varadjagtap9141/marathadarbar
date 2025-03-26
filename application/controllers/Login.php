<?php
class Login extends CI_Controller
{
    public function index()
    {
        echo "hello world -----------";
        $this->load->view('login_form');
    }
}
?>