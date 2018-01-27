<?php
    class City_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->load->database();
        }

        public function city_list(){
            $res = $this->db->get('city_master');
            return $res->result();
        }

        public function city_data($city_id_pk)
        {
            $query = $this->db->get_where('city_master',array('city_id_pk' => $city_id_pk));
            return $query->result();
        }

        public function insert_city($data){
            return $this->db->insert('city_master',$data);
        }

        public function delete_city($id){
            $this->db->where('city_id_pk',$id);
            // $this->db->set('is_active','0');
            // $this->db->set('modified_on','NOW()',FALSE);
            return $this->db->update('city_master');
        }

        public function update_city($data){
            $this->db->where('city_id_pk',$data['city_id_pk']);
            // $this->db->set('modified_on','NOW()',FALSE);
            return $this->db->update('city_master',$data);
        }
    }
?>