<?php
    class Local_Transfer_price_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->load->database();
        }

        public function local_transfer_price_list(){
            return $this->db->get_where('local_transfer_price_master',array('is_active'=>'1'));
        }

        public function local_transfer_price_data($local_transfer_id_pk)
        {
            $query = $this->db->get_where('local_transfer_price_master',array('is_active' => '1', 'local_transfer_id_pk' => $local_transfer_id_pk));
            return $query->array();
        }

        public function insert_local_transfer_price($data){
            return $this->db->insert('local_transfer_price_master',$data);
        }

        public function delete_local_transfer_price($id){
            $this->db->where('local_transfer_id_pk',$id);
            $this->db->set('is_active','0');
            $this->db->set('modified_on','NOW()',FALSE);
            $this->db->update('local_transfer_price_master');
        }

        public function update_local_transfer_price($data){
            $this->db->where('local_transfer_id_pk',$data['local_transfer_id_pk']);
            $this->db->set('modified_on','NOW()',FALSE);
            $this->db->update('local_transfer_price_master',$data);
        }
    }
?>