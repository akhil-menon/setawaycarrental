<?php
    class Outstation_price_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->load->database();
        }

        public function outstation_price_list(){
            return $this->db->get_where('outstation_price_master',array('is_active'=>'1'));
        }

        public function outstation_price_data($outstation_price_id_pk)
        {
            $query = $this->db->get_where('outstation_price_master',array('is_active' => '1', 'outstation_price_id_pk' => $outstation_price_id_pk));
            return $query->array();
        }

        public function insert_outstation_price($data){
            return $this->db->insert('outstation_price_master',$data);
        }

        public function delete_outstation_price($id){
            $this->db->where('outstation_price_id_pk',$id);
            $this->db->set('is_active','0');
            $this->db->set('modified_on','NOW()',FALSE);
            $this->db->update('outstation_price_master');
        }

        public function update_outstation_price($data){
            $this->db->where('outstation_price_id_pk',$data['outstation_price_id_pk']);
            $this->db->set('modified_on','NOW()',FALSE);
            $this->db->update('outstation_price_master',$data);
        }
    }
?>