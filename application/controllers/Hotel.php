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
        $this->load->view('hotel/index');
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
        $cond=['hotel_id'=>$_SESSION['hotel_id']];
        $data['category']=$this->My_model->select_where("category",$cond);
        $this->load->view('hotel/manage_category',$data);
        $this->footer();
    }
    public function save_category()
    {
        $_POST['hotel_id'] = $_SESSION['hotel_id'];
        $this->My_model->save("category",$_POST);
        redirect(base_url('hotel/manage_category'));
    }
}
?>