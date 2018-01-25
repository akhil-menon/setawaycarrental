<?php
    class Client extends CI_Controller{
        function __construct() {
            parent::__construct();
            header('Content-Type: application/json');
            $this->load->model('User_model');
        }

        public function dologin($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['email'] = $this->input->get('email');
                $data['password'] = $this->input->get('password');
            }
            $user = $this->User_model->user_auth($data['email'],$data['password']);
            if (count($user) > 0) {
                $res['msg'] = "Login Successful";
            } else {
                $res['msg'] = "Sorry!UserName Or Password is incorrect";
            }
            $res['data'] = $user;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }

        public function register_user($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['name'] = $this->input->get('name');
                $data['user_type'] = $this->input->get('user_type');
                $data['company_id_fk'] = $this->input->get('company_id_fk');
                $data['address'] = $this->input->get('address');
                $data['email'] = $this->input->get('email');
                $data['contact_no'] = $this->input->get('contact_no');
                // $data['password'] = $this->input->get('password');
            }
            $user = $this->User_model->insert_user($data);
            if (count($user) > 0) {
                $res['msg'] = "Successfully Added";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $user;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
    }
?>