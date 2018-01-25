<?php
    class Extracharge_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->load->database();
        }

        public function extracharge_list(){
            return $this->db->get_where('extracharge_master',array('is_active'=>'1'));
        }

        public function insert_extracharge($data){
            return $this->db->insert('extracharge_master',$data);
        }

        public function delete_extracharge($id){
            $this->db->where('extra_charge_id_pk',$id);
            $this->db->set('is_active','0');
            $this->db->set('modified_on','NOW()',FALSE);
            $this->db->update('extracharge_master');
        }

        public function update_extracharge($data){
            $this->db->where('extra_charge_id_pk',$data['extra_charge_id_pk']);
            $this->db->set('modified_on','NOW()',FALSE);
            $this->db->update('extracharge_master',$data);
        }
    }
?>