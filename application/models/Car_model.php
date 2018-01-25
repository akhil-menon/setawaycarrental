<?php
    class Car_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->load->database();
        }

        public function car_list(){
            return $this->db->get_where('car_master',array('is_active'=>'1'));
        }

        public function insert_car($data){
            return $this->db->insert('car_master',$data);
        }

        public function delete_car($id){
            $this->db->where('car_id_pk',$id);
            $this->db->set('is_active','0');
            $this->db->set('modified_on','NOW()',FALSE);
            $this->db->update('car_master');
        }

        public function update_car($data){
            $this->db->where('car_id_pk',$data['car_id_pk']);
            $this->db->set('modified_on','NOW()',FALSE);
            $this->db->update('car_master',$data);
        }
    }
?>