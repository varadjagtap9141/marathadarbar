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
        $this->load->view('hotel/manage_table');
        $this->footer();
    }  
    public function save_table()
    {
        $_POST['hotel_id'] = $_SESSION['hotel_id'];
        $this->My_model->save("hotel_table",$_POST);
        redirect(base_url('hotel/manage_table'));
    }
}
?>