<?php
    class State_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->load->database();
        }

        public function state_list(){
            return $this->db->get('state_master')->result();
        }

        public function state_data($state_id_pk)
        {
            $query = $this->db->get_where('state_master',array('state_id_pk' => $state_id_pk));
            return $query->result();
        }

        public function insert_state($data){
            return $this->db->insert('state_master',$data);
        }

        public function delete_state($id){
            $this->db->where('state_id_pk',$id);
            // $this->db->set('is_active','0');
            // $this->db->set('modified_on','NOW()',FALSE);
            return $this->db->update('state_master');
        }

        public function update_state($data){
            $this->db->where('state_id_pk',$data['state_id_pk']);
            // $this->db->set('modified_on','NOW()',FALSE);
            return $this->db->update('state_master',$data);
        }
    }
?>