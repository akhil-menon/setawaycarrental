<?php
    class Trip_type_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->load->database();
        }

        public function trip_type_list(){
            return $this->db->get_where('trip_type_master',array('is_active'=>'1'));
        }

        public function insert_trip_type($data){
            return $this->db->insert('trip_type_master',$data);
        }

        public function delete_trip_type($id){
            $this->db->where('trip_type_id_pk',$id);
            $this->db->set('is_active','0');
            $this->db->set('modified_on','NOW()',FALSE);
            $this->db->update('trip_type_master');
        }

        public function update_trip_type($data){
            $this->db->where('trip_type_id_pk',$data['trip_type_id_pk']);
            $this->db->set('modified_on','NOW()',FALSE);
            $this->db->update('trip_type_master',$data);
        }
    }
?>