<?php
class My_model extends CI_model
{
    public function save($tname,$data)
    {
        $this->db->insert($tname,$data);
        return $this->db->insert_id();
    }
    public function select($tname)
    {
        return $this->db->get($tname)->result_array();
    }
    public function select_where($tname,$cond)
    {
        return $this->db->where($cond)->get($tname)->result_array();
    }
    public function update($tname,$cond,$data)
    {
        $this->db->where($cond)->update($tname,$data);
    }
    public function delete($tname,$cond)
    {
        $this->db->where($cond)->delete($tname);
    }
    public function get_category()
    {
        $cond=['hotel_id'=>$_SESSION['hotel_id']];
        return $this->select_where("category",$cond);
    }
    public function get_products()
    {
        return $this->db->query("SELECT * FROM product,category WHERE product.category_id=category.category_id")->result_array();
    }
    public function search_product($name)
    {
        return $this->db->query("SELECT * FROM product,category WHERE product.category_id=category.category_id AND (product_name LIKE '%$name%' OR category_name LIKE '%$name%')")->result_array();
    }
    public function search_category($name)
    {
        return $this->db->query("SELECT * FROM category WHERE category_name LIKE '%$name%'")->result_array();
    }
}
?>