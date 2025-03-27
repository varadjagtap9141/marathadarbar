<?php
class Login extends CI_Controller
{
    public function index()
    {
        $this->load->view('login_form');
    }
    public function sign_in()
    {
        if(isset($_POST['email']) && isset($_POST['password']))
        {
            $cond['hotel_email'] = $_POST['email'];
            $cond['hotel_password'] =$_POST['password'];
            $data=$this->My_model->select_where("hotel",$cond);
            // print_r($data);
            if($data[0]['hotel_id'])
            {
                $_SESSION['hotel_id']=$data[0]['hotel_id'];
                redirect(base_url('hotel'));
            }
            else
            {
                $this->session->set_flashdata('error','Invalid Email or Password');
                redirect(base_url('login'));
            }
        }
    }
}
?>