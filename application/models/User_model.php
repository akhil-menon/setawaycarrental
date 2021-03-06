<?php
    class User_model extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function user_list()
        {
            //dcscsdcs
            $query = $this->db->get_where('user_master', array('is_active' => '1'));
            return $query->result();
        }

        public function user_data($user_email)
        {
            $query = $this->db->get_where('user_master',array('is_active' => '1', 'email' => $user_email));
            return $query->result();
        }

        //Insert User
        public function insert_user($data) 
        {
            $data1['name'] = $data['name'];
            $data1['user_type'] = $data['user_type'];
            $data1['company_id_fk'] = $data['company_id_fk'];
            $data1['address'] = $data['address'];
            $data1['email'] = $data['email'];
            $data1['contact_no'] = $data['contact_no'];
            
            $this->db->insert('user_master', $data1);
            $user_id_fk = $this->db->insert_id();
    

            return $this->db->insert('authenticate_master',array('user_id_fk'=>$user_id_fk,'password'=>$data['password']));
        }

        //Delete User
        public function delete_user($id) 
        {
            $this->db->where('user_id_pk', $id);
            $this->db->set('is_active', 0);
            $this->db->set('modified_on', 'NOW()', FALSE);
            return $this->db->update('user_master');
        }

        public function update_user($data) 
        {
            $this->db->where('user_id_pk', $data['user_id_pk']);
            $this->db->set('modified_on', 'NOW()', FALSE);
            return $this->db->update('user_master', $data);
        }

        public function user_auth($email, $password)
        {
            $user_id_pk= $this->db->select('user_id_pk')
                                ->from('user_master')
                                ->where(array('email'=>$email,'is_active'=>'1'))->get()->result();
            $user_id_fk = $user_id_pk[0]->{'user_id_pk'};
            $query = $this->db->get_where('authenticate_master',array('is_active' => 1, 'user_id_fk' => $user_id_fk, 'password' => $password));
            return $query->row_array();
        }

        public function resetpassword($id, $data) {
            $this->db->where('user_id_fk', $id);
            $this->db->set('modified_on', 'NOW()', FALSE);
            return $this->db->update('authenticate_master', array('password'=>$data));
        }
    }
?>