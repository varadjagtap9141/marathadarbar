<?php
class Hotel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!isset($_SESSION['hotel_id']))
        {
            redirect(base_url('login'));
            exit;
        }
    }
    protected function navbar()
    {
        $this->load->view('hotel/navbar');
    }
    protected function footer()
    {
        $this->load->view('hotel/footer');
    }
    public function index()
    {
        $this->navbar();
        $data['tables']=$this->My_model->select_where("hotel_table", ['hotel_id' => $_SESSION['hotel_id']]);
        $this->load->view('hotel/index', $data);
        $this->footer();
    }
    public function manage_table()
    {
        $this->navbar();
        $cond=['hotel_id'=>$_SESSION['hotel_id']];
        $data['tables']= $this->My_model->select_where("hotel_table",$cond);
        $this->load->view('hotel/manage_table',$data);
        $this->footer();
    }  
    public function save_table()
    {
        $_POST['hotel_id'] = $_SESSION['hotel_id'];
        $this->My_model->save("hotel_table",$_POST);
        redirect(base_url('hotel/manage_table'));
    }
    public function delete_table($id)
    {
        $cond=['table_id'=>$id];
        $this->My_model->delete("hotel_table", $cond);
        redirect(base_url('hotel/manage_table'));
    }
    //hotel table edit,update pending
    // category CRUD
    public function manage_category()
    {
        $this->navbar();
        $data['category']=$this->My_model->get_category();
        $this->load->view('hotel/manage_category',$data);
        $this->footer();
    }
    public function save_category()
    {
        $_POST['hotel_id'] = $_SESSION['hotel_id'];
        $this->My_model->save("category",$_POST);
        redirect(base_url('hotel/manage_category'));
    }
    //category edit,update,delete pending
    public function add_product()
    {
        $this->navbar();
        $data['category']=$this->My_model->get_category();
        $this->load->view('hotel/add_product',$data);
        $this->footer();
    }
    public function save_product()
    {
        $_POST['hotel_id']=$_SESSION['hotel_id'];
        $_POST['product_img']=$product_img=time().$_FILES['product_img']['name'];
        move_uploaded_file($_FILES['product_img']['tmp_name'],"upload/".$product_img);
        $this->My_model->save("product",$_POST);
        redirect(base_url('hotel/add_product'));
    }
    public function product_list()
    {
        $this->navbar();
        $data['products']=$this->My_model->get_products();
        $this->load->view('hotel/product_list',$data);
        $this->footer();
    }
    public function order_details($order_id)
    {
        $this->navbar();
        $data['order']=$this->My_model->select_where("order_table",["order_id"=>$order_id])[0];
        $sql="SELECT * FROM product,order_product WHERE order_id='$order_id' AND product.product_id=order_product.product_id";
        $data['order_product']=$this->db->query($sql)->result_array();
        $this->load->view('hotel/order_details',$data);
        $this->footer();
        
    }
    public function generate_bill($order_id)
    {
        $cond=['order_id'=>$order_id];
        $data=['status'=>'completed'];
        $this->My_model->update("order_table",$cond,$data);
        redirect(base_url('hotel/order_details')."/".$order_id);
    }
}
?>