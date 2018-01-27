<?php
    class Logsheet_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->load->database();
        }

        public function logsheet_list(){
            return $this->db->get_where('logsheet_master',array('is_active'=>'1'))->result();
        }

        
        public function logsheet_data($logsheet_id_pk)
        {
            $query = $this->db->get_where('logsheet_master',array('is_active' => '1', 'logsheet_id_pk' => $logsheet_id_pk));
            return $query->result();
        }

        public function insert_logsheet($data){
            return $this->db->insert('logsheet_master',$data);
        }

        public function delete_logsheet($id){
            $this->db->where('logsheet_id_pk',$id);
            $this->db->set('is_active','0');
            $this->db->set('modified_on','NOW()',FALSE);
            return $this->db->update('logsheet_master');
        }

        public function update_logsheet($data){
            $this->db->where('logsheet_id_pk',$data['logsheet_id_pk']);
            $this->db->set('modified_on','NOW()',FALSE);
            return $this->db->update('logsheet_master',$data);
        }
    }
?>