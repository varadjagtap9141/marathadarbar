<?php
class User extends CI_Controller
{
    public function index()
    {
        $_SESSION['table_id']=$_GET['table_id'];
        $data['category']=$this->My_model->get_category();
        $data['products']=$this->My_model->get_products();
        $this->load->view("user/products",$data);
    }
    public function add_product_session()
    {
        $_SESSION['cart'][$_GET['product_id']]=$_GET['qty'];
        echo json_encode(["status"=>"success"]);
    }
    public function send_to_kitchen()
    {
        print_r($_SESSION['cart']);
        print_r($_SESSION['table_id']);

    }
}
?>