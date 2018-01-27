<?php
    class Company_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->load->database();
        }

        public function company_list(){
            return $this->db->get_where('company_master',array('is_active'=>'1'))->result();
        }

        public function comany_data($company_id_pk)
        {
            $query = $this->db->get_where('company_master',array('is_active' => '1', 'company_id_pk' => $company_id_pk));
            return $query->result();
        }

        public function insert_company($data){
            return $this->db->insert('company_master',$data);
        }

        public function delete_company($id){
            $this->db->where('company_id_pk',$id);
            $this->db->set('is_active','0');
            $this->db->set('modified_on','NOW()',FALSE);
            return $this->db->update('company_master');
        }

        public function update_company($data){
            $this->db->where('company_id_pk',$data['company_id_pk']);
            $this->db->set('modified_on','NOW()',FALSE);
            return $this->db->update('company_master',$data);
        }
    }
?>