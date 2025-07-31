<?php
class Customer_model extends CI_Model
{
    public function get_customers()
    {
        return $this->db->get('customers')->result();
    }

    public function get_customer($id)
    {
        return $this->db->get_where('customers', ['id' => $id])->row();
    }
}
