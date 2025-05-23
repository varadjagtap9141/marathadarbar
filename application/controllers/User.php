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
        $this->load->view("user/send_to_kitchen");
        
        $order=[
            "order_date"=>date("Y-m-d"),
            "table_id"=>$_SESSION['table_id'],
            "order_time"=>date("H:i"),
            "status"=>"active",
        ];
        $sql="SELECT * FROM order_table WHERE table_id='".$_SESSION['table_id']."' AND status='active'";
        $data=$this->db->query($sql)->result_array();
        if(count($data)>0)
        {
            $order_id=$data[0]['order_id'];
        }
        else
        {
            $order_id=$this->My_model->save("order_table",$order);
        }

        foreach($_SESSION['cart'] as $product_id=>$qty)
        {
            $product=$this->My_model->select_where("product",["product_id"=>$product_id]);
            $product_price=$product[0]['product_price'];
            $total=$product_price*$qty;

            
            $order_product=[
                "order_id"=>$order_id,
                "product_id"=>$product_id,
                "qty"=>$qty,
                "product_price"=>$product_price,
                "total"=>$total
            ];
            $this->My_model->save("order_product",$order_product);
            unset($_SESSION['cart']);
        }
    }
}
?>