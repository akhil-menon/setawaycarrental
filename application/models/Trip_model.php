<?php
    class Trip_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->load->database();
        }

        public function trip_list(){
            return $this->db->get_where('trip_master',array('is_active'=>'1'))->result();
        }

        public function trip_data($trip_id_pk)
        {
            $query = $this->db->get_where('trip_master',array('is_active' => '1', 'trip_id_pk' => $trip_id_pk));
            return $query->result();
        }

        public function insert_trip($data){
            return $this->db->insert('trip_master',$data);
        }

        public function delete_trip($id){
            $this->db->where('trip_id_pk',$id);
            $this->db->set('is_active','0');
            $this->db->set('modified_on','NOW()',FALSE);
            return $this->db->update('trip_master');
        }

        public function update_trip($data){
            $this->db->where('trip_id_pk',$data['trip_id_pk']);
            $this->db->set('modified_on','NOW()',FALSE);
            return $this->db->update('trip_master',$data);
        }
    }
?>