<?php
class User extends CI_Controller
{
    public function index()
    {
        $data['products']=$this->My_model->get_products();
        $this->load->view("user/products",$data);
    }
}
?>