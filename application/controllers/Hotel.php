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
    public function logout()
    {
        unset($_SESSION['hotel_id']);
        redirect(base_url('login'));
    }
    public function index()
    {
        $this->navbar();
        $data['tables']=$this->My_model->select_where("hotel_table", ['hotel_id' => $_SESSION['hotel_id']]);
        // for dates & amounts charts
        $dates=[];
        $amounts=[] ;
        for($i=0;$i<7;$i++)
        {
            $d=date('Y-m-d', strtotime("-$i day"));
            $dates[]=$d;

            $sql="SELECT SUM((SELECT SUM(total) FROM order_product WHERE order_table.order_id=order_product.order_id)) as ttl FROM order_table WHERE order_date='$d'";
            $result=$this->db->query($sql)->result_array();
            $amounts[]=(int)$result[0]['ttl'];
        }
        $data['x_axis']=$dates;
        $data['y_axis']=$amounts;
        
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
    public function edit_category($id)
    {
        $this->navbar();
        $cond=['category_id'=>$id];
        $data['category']=$this->My_model->select_where("category",$cond)[0];
        $this->load->view('hotel/edit_category',$data);
        $this->footer();
    }
    public function update_category()
    {
        $cond=['category_id'=>$_POST['category_id']];
        $this->My_model->update("category",$cond,$_POST);
        redirect(base_url('hotel/manage_category'));
    }
    public function delete_category($id)
    {
        $cond=['category_id'=>$id];
        $this->My_model->delete("category",$cond);
        redirect(base_url('hotel/manage_category'));
    }
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
        if(isset($_GET['search']))
        {
            $data['products']=$this->My_model->search_product($_GET['search']);
        }
        else
        {
            $data['products']=$this->My_model->get_products();
        }
        $this->load->view('hotel/product_list',$data);
        $this->footer();
    }
    // product edit, update, delete
    public function order_details($order_id)
    {
        $this->navbar();
        $data['hotel_id']=$_SESSION['hotel_id'];
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