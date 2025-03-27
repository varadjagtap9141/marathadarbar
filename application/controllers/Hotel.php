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
    public function products()
    {
        $this->navbar();
        $this->load->view('hotel/products');
        $this->footer();
    }  
}
?>