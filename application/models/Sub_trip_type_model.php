<?php
    class Sub_trip_type_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->load->database();
        }

        public function sub_trip_type_list(){
            return $this->db->get_where('sub_trip_type_master',array('is_active'=>'1'));
        }

        public function sub_trip_type_data($sub_trip_type_id_pk)
        {
            $query = $this->db->get_where('sub_trip_type_master',array('is_active' => '1', 'sub_trip_type_id_pk' => $sub_trip_type_id_pk));
            return $query->array();
        }

        public function insert_sub_trip_type($data){
            return $this->db->insert('sub_trip_type_master',$data);
        }

        public function delete_sub_trip_type($id){
            $this->db->where('sub_trip_type_id_pk',$id);
            $this->db->set('is_active','0');
            $this->db->set('modified_on','NOW()',FALSE);
            $this->db->update('sub_trip_type_master');
        }

        public function update_sub_trip_type($data){
            $this->db->where('sub_trip_type_id_pk',$data['sub_trip_type_id_pk']);
            $this->db->set('modified_on','NOW()',FALSE);
            $this->db->update('sub_trip_type_master',$data);
        }
    }
?>