<?php
    class City_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->load->database();
        }

        public function city_list(){
            return $this->db->get_where('city_master',array('is_active'=>'1'));
        }

        public function insert_city($data){
            return $this->db->insert('city_master',$data);
        }

        public function delete_city($id){
            $this->db->where('city_id_pk',$id);
            $this->db->set('is_active','0');
            $this->db->set('modified_on','NOW()',FALSE);
            $this->db->update('city_master');
        }

        public function update_city($data){
            $this->db->where('city_id_pk',$data['city_id_pk']);
            $this->db->set('modified_on','NOW()',FALSE);
            $this->db->update('city_master',$data);
        }
    }
?>