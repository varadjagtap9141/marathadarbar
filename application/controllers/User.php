<?php
class User extends CI_Controller
{
    public function index()
    {
        $data['category']=$this->My_model->get_category();
        $data['products']=$this->My_model->get_products();
        $this->load->view("user/products",$data);
    }
    public function add_product_session()
    {
        $_SESSION['cart'][$_GET['product_id']]=$_GET['qty'];
        echo json_encode(["status"=>"success"]);
    }
}
?>