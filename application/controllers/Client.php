<?php
    class Client extends CI_Controller{
        function __construct() {
            parent::__construct();
            header('Content-Type: application/json');
            $this->load->model('User_model');
            $this->load->model('Company_model');
            $this->load->model('Car_model');
            $this->load->model('City_model');
            $this->load->model('Extracharge_model');
            $this->load->model('Local_Transfer_price_model');
            $this->load->model('Logsheet_model');
            $this->load->model('Outstation_price_model');
            $this->load->model('State_model');
            $this->load->model('Sub_trip_type_model');
            $this->load->model('Trip_model');
            $this->load->model('Trip_type_model');
        }
        public function user_login($args = array()){
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
                $data['password'] = $this->input->get('password');
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
        public function forget_password($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['user_id_pk'] = $this->input->get('user_id_pk');
            }
            $user = $this->User_model->user_data($data['user_id_pk']);
            if (count($user) > 0) {
                $res['msg'] = "Success";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $user;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($user[0]->{'email'});
        }
        public function reset_password($args = array()) {
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['user_id_pk'] = $this->input->post('user_id_pk');
                $data['password'] = $this->input->post('password');
            }
    
            $user = $this->user_model->resetpassword($data['user_id_pk'], $data['password']);
            if (count($user) > 0) {
                $res['msg'] = "Password Changed";
            }
            $res['data'] = $user;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($user);
        }
        public function edit_user($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['user_id_pk'] = $this->input->get('user_id_pk');
            }
            $user = $this->User_model->user_data($data['user_id_pk']);
            if (count($user) > 0) {
                $res['msg'] = "Success";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $user;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function update_user($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['user_id_pk'] = $this->input->get('user_id_pk');
                $data['name'] = $this->input->get('name');
                $data['user_type'] = $this->input->get('user_type');
                $data['company_id_fk'] = $this->input->get('company_id_fk');
                $data['address'] = $this->input->get('address');
                $data['email'] = $this->input->get('email');
                $data['contact_no'] = $this->input->get('contact_no');
            }
            $user = $this->User_model->update_user($data);
            if (count($user) > 0) {
                $res['msg'] = "Successfully Updated";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $user;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function company_list(){
            $benchmarkTimeStar = microtime(1);
            $company = $this->Company_model->company_list();
            if (count($company) > 0) {
                $res['msg'] = "Success";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $company;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function insert_company($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['name'] = $this->input->get('name');
                $data['address'] = $this->input->get('address');
                $data['email'] = $this->input->get('email');
                $data['description'] = $this->input->get('description');
                $data['contact_no'] = $this->input->get('contact_no');
            }
            $company = $this->Company_model->insert_company($data);
            if (count($company) > 0) {
                $res['msg'] = "Successfully Added";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $company;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function edit_company($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['company_id_pk'] = $this->input->get('company_id_pk');
            }
            $company = $this->User_model->company_data($data['company_id_pk']);
            if (count($company) > 0) {
                $res['msg'] = "Success";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $company;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function update_company($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['company_id_pk'] = $this->input->get('company_id_pk');
                $data['name'] = $this->input->get('name');
                $data['address'] = $this->input->get('address');
                $data['email'] = $this->input->get('email');
                $data['description'] = $this->input->get('description');
                $data['contact_no'] = $this->input->get('contact_no');
            }
            $company = $this->Company_model->update_company($data);
            if (count($company) > 0) {
                $res['msg'] = "Successfully updated";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $company;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);   
        }
        public function delete_company($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['company_id_pk'] = $this->input->get('company_id_pk');
            }
            $company = $this->Company_model->delete_company($data['company_id_pk']);
            if (count($company) > 0) {
                $res['msg'] = "Successfully deleted";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $company;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        
        public function car_list(){
            $benchmarkTimeStar = microtime(1);
            $car = $this->Car_model->car_list();
            if (count($car) > 0) {
                $res['msg'] = "Success";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $car;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function insert_car($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['name'] = $this->input->get('name');
                $data['car_type'] = $this->input->get('car_type');
                $data['seating_capacity'] = $this->input->get('seating_capacity');
            }
            $car = $this->Car_model->insert_car($data);
            if (count($car) > 0) {
                $res['msg'] = "Successfully Added";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $car;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function edit_car($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['car_id_pk'] = $this->input->get('car_id_pk');
            }
            $car = $this->User_model->car_data($data['car_id_pk']);
            if (count($car) > 0) {
                $res['msg'] = "Success";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $car;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function update_car($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['car_id_pk'] = $this->input->get('car_id_pk');
                $data['name'] = $this->input->get('name');
                $data['car_type'] = $this->input->get('car_type');
                $data['seating_capacity'] = $this->input->get('seating_capacity');
            }
            $car = $this->Car_model->update_company($data);
            if (count($car) > 0) {
                $res['msg'] = "Successfully updated";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $car;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);   
        }
        public function delete_car($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['car_id_pk'] = $this->input->get('car_id_pk');
            }
            $car = $this->Car_model->delete_car($data['car_id_pk']);
            if (count($car) > 0) {
                $res['msg'] = "Successfully deleted";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $car;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function trip_type_list(){
            $benchmarkTimeStar = microtime(1);
            $triptype = $this->Trip_type_model->trip_type_list();
            if (count($triptype) > 0) {
                $res['msg'] = "Success";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $triptype;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function insert_trip_type($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['trip_type'] = $this->input->get('trip_type');
            }
            $triptype = $this->Trip_type_model->insert_trip_type($data);
            if (count($triptype) > 0) {
                $res['msg'] = "Successfully Added";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $triptype;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function edit_trip_type($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['trip_type_id_pk'] = $this->input->get('trip_type_id_pk');
            }
            $triptype = $this->Trip_type_model->trip_type_data($data['trip_type_id_pk']);
            if (count($triptype) > 0) {
                $res['msg'] = "Success";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $triptype;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);   
        }
        public function update_trip_type($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['trip_type_id_pk'] = $this->input->get('trip_type_id_pk');;
                $data['trip_type'] = $this->input->get('trip_type');
            }
            $triptype = $this->Trip_type_model->update_trip_type($data);
            if (count($triptype) > 0) {
                $res['msg'] = "Successfully Updated";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $triptype;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function delete_trip_type($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['trip_type_id_pk'] = $this->input->get('trip_type_id_pk');
            }
            $triptype = $this->Trip_type_model->delete_car($data['trip_type_id_pk']);
            if (count($triptype) > 0) {
                $res['msg'] = "Successfully deleted";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $triptype;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function sub_trip_type_list(){
            $benchmarkTimeStar = microtime(1);
            $subtriptype = $this->Sub_trip_type_model->sub_trip_type_list();
            if (count($subtriptype) > 0) {
                $res['msg'] = "Success";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $subtriptype;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function insert_sub_trip_type($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['name'] = $this->input->get('name');
                $data['trip_type_id_fk'] = $this->input->get('trip_type_id_fk');
            }
            $subtriptype = $this->Sub_trip_type_model->insert_sub_trip_type($data);
            if (count($subtriptype) > 0) {
                $res['msg'] = "Successfully Added";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $subtriptype;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function edit_sub_trip_type($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['sub_trip_type_id_pk'] = $this->input->get('sub_trip_type_id_pk');
            }
            $subtriptype = $this->Sub_trip_type_model->sub_trip_type_data($data['sub_trip_type_id_pk']);
            if (count($subtriptype) > 0) {
                $res['msg'] = "Success";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $subtriptype;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function update_sub_trip_type($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['sub_trip_type_id_fk'] = $this->input->get('sub_trip_type_id_fk');
                $data['name'] = $this->input->get('name');
                $data['trip_type_id_fk'] = $this->input->get('trip_type_id_fk');
            }
            $subtriptype = $this->Sub_trip_type_model->update_sub_trip_type($data);
            if (count($subtriptype) > 0) {
                $res['msg'] = "Successfully Updated";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $subtriptype;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function delete_sub_trip_type($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['sub_trip_type_id_pk'] = $this->input->get('sub_trip_type_id_pk');
            }
            $subtriptype = $this->Sub_trip_type_model->delete_sub_trip_type($data['sub_trip_type_id_pk']);
            if (count($subtriptype) > 0) {
                $res['msg'] = "Successfully deleted";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $subtriptype;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function city_list(){
            $benchmarkTimeStar = microtime(1);
            $city = $this->City_model->city_list();
            if (count($city) > 0) {
                $res['msg'] = "Success";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $city;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function insert_city($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['name'] = $this->input->get('name');
                $data['state_id_fk'] = $this->input->get('state_id_fk');
                $data['driver_allowance'] = $this->input->get('driver_allowance');
            }
            $city = $this->City_model->insert_city($data);
            if (count($city) > 0) {
                $res['msg'] = "Successfully Added";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $city;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function edit_city($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['city_id_pk'] = $this->input->get('city_id_pk');
            }
            $city = $this->City_model->city_data($data['city_id_pk']);
            if (count($city) > 0) {
                $res['msg'] = "Success";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $city;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function update_city($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['city_id_pk'] = $this->input->get('city_id_pk');
                $data['name'] = $this->input->get('name');
                $data['state_id_fk'] = $this->input->get('state_id_fk');
                $data['driver_allowance'] = $this->input->get('driver_allowance');
            }
            $city = $this->City_model->update_city($data);
            if (count($city) > 0) {
                $res['msg'] = "Successfully Updated";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $city;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function delete_city($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['city_id_pk'] = $this->input->get('city_id_pk');
            }
            $city = $this->City_model->delete_city($data['city_id_pk']);
            if (count($city) > 0) {
                $res['msg'] = "Successfully deleted";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $city;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function state_list(){
            $benchmarkTimeStar = microtime(1);
            $state = $this->State_model->state_list();
            if (count($state) > 0) {
                $res['msg'] = "Success";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $state;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function insert_state($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['name'] = $this->input->get('name');
            }
            $state = $this->State_model->insert_state($data);
            if (count($state) > 0) {
                $res['msg'] = "Successfully Added";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $state;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function edit_state($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['state_id_pk'] = $this->input->get('state_id_pk');
            }
            $state = $this->State_model->state_data($data['state_id_pk']);
            if (count($state) > 0) {
                $res['msg'] = "Success";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $state;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function update_state($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['state_id_pk'] = $this->input->get('state_id_pk');
                $data['name'] = $this->input->get('name');
            }
            $state = $this->State_model->update_state($data);
            if (count($state) > 0) {
                $res['msg'] = "Successfully Updated";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $state;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function delete_state($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['state_id_pk'] = $this->input->get('state_id_pk');
            }
            $state = $this->State_model->delete_state($data['state_id_pk']);
            if (count($state) > 0) {
                $res['msg'] = "Successfully deleted";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $state;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function trip_list(){
            $benchmarkTimeStar = microtime(1);
            $trip = $this->Trip_model->trip_list();
            if (count($trip) > 0) {
                $res['msg'] = "Success";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $trip;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function insert_trip($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['sub_trip_type_id_fk'] = $this->input->get('sub_trip_type_id_fk');
                $data['days'] = $this->input->get('days');
                $data['date'] = $this->input->get('date');
                $data['time'] = $this->input->get('time');
                $data['source_city'] = $this->input->get('source_city');
                $data['destination_city'] = $this->input->get('destination_city');
                $data['car_id_fk'] = $this->input->get('car_id_fk');
                $data['traveller_name'] = $this->input->get('traveller_name');
                $data['traveller_contact_no'] = $this->input->get('traveller_contact_no');
                $data['traveller_email'] = $this->input->get('traveller_email');
                $data['traveller_pick_up_address'] = $this->input->get('traveller_pick_up_address');
                $data['driver_id_fk'] = $this->input->get('driver_id_fk');
                $data['car_no'] = $this->input->get('car_no');
                $data['is_approved'] = $this->input->get('is_approved');
                $data['company_id_fk'] = $this->input->get('company_id_fk');
                $data['reason'] = $this->input->get('reason');
                $data['traveller_drop_location'] = $this->input->get('traveller_drop_location');
            }
            $trip = $this->Trip_model->insert_trip($data);
            if (count($trip) > 0) {
                $res['msg'] = "Successfully Added";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $trip;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function edit_trip($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['trip_id_pk'] = $this->input->get('trip_id_pk');
            }
            $trip = $this->Trip_model->trip_data($data['trip_id_pk']);
            if (count($trip) > 0) {
                $res['msg'] = "Success";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $trip;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);   
        }
        public function update_trip($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['trip_id_pk'] = $this->input->get('trip_id_pk');
                $data['sub_trip_type_id_fk'] = $this->input->get('sub_trip_type_id_fk');
                $data['days'] = $this->input->get('days');
                $data['date'] = $this->input->get('date');
                $data['time'] = $this->input->get('time');
                $data['source_city'] = $this->input->get('source_city');
                $data['destination_city'] = $this->input->get('destination_city');
                $data['car_id_fk'] = $this->input->get('car_id_fk');
                $data['traveller_name'] = $this->input->get('traveller_name');
                $data['traveller_contact_no'] = $this->input->get('traveller_contact_no');
                $data['traveller_email'] = $this->input->get('traveller_email');
                $data['traveller_pick_up_address'] = $this->input->get('traveller_pick_up_address');
                $data['driver_id_fk'] = $this->input->get('driver_id_fk');
                $data['car_no'] = $this->input->get('car_no');
                $data['is_approved'] = $this->input->get('is_approved');
                $data['company_id_fk'] = $this->input->get('company_id_fk');
                $data['reason'] = $this->input->get('reason');
                $data['traveller_drop_location'] = $this->input->get('traveller_drop_location');
            }
            $trip = $this->Trip_model->update_trip($data);
            if (count($trip) > 0) {
                $res['msg'] = "Successfully Updated";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $trip;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function delete_trip($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['trip_id_pk'] = $this->input->get('trip_id_pk');
            }
            $trip = $this->Trip_model->delete_trip($data['trip_id_pk']);
            if (count($trip) > 0) {
                $res['msg'] = "Successfully deleted";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $trip;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function insert_logsheet($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['logsheet_id_pk'] = $this->input->get('logsheet_id_pk');
                $data['trip_id_fk'] = $this->input->get('trip_id_fk');
                $data['start_date_time'] = $this->input->get('start_date_time');
                $data['start_km'] = $this->input->get('start_km');
                $data['end_date_time'] = $this->input->get('end_date_time');
                $data['end_km'] = $this->input->get('end_km');
                $data['signature'] = $this->input->get('signature');
            }
            $logsheet = $this->Logsheet_model->insert_logsheet($data);
            if (count($logsheet) > 0) {
                $res['msg'] = "Successfully Added";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $logsheet;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        
        public function edit_logsheet($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['logsheet_id_pk'] = $this->input->get('logsheet_id_pk');
            }
            $logsheet = $this->Logsheet_model->logsheet_data($data['logsheet_id_pk']);
            if (count($logsheet) > 0) {
                $res['msg'] = "Success";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $logsheet;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);   
        }
        public function update_logsheet($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['logsheet_id_pk'] = $this->input->get('logsheet_id_pk');
                $data['trip_id_fk'] = $this->input->get('trip_id_fk');
                $data['start_date_time'] = $this->input->get('start_date_time');
                $data['start_km'] = $this->input->get('start_km');
                $data['end_date_time'] = $this->input->get('end_date_time');
                $data['end_km'] = $this->input->get('end_km');
                $data['signature'] = $this->input->get('signature');
            }
            $logsheet = $this->Logsheet_model->update_logsheet($data);
            if (count($logsheet) > 0) {
                $res['msg'] = "Successfully Updated";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $logsheet;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function delete_logsheet($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['logsheet_id_pk'] = $this->input->get('logsheet_id_pk');
            }
            $logsheet = $this->Logsheet_model->delete_logsheet($data['logsheet_id_pk']);
            if (count($logsheet) > 0) {
                $res['msg'] = "Successfully deleted";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $logsheet;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }

        public function insert_extracharge($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['extra_charge_id_pk'] = $this->input->get('extra_charge_id_pk');
                $data['trip_id_fk'] = $this->input->get('trip_id_fk');
                $data['charge_detail'] = $this->input->get('charge_detail');
                $data['amount'] = $this->input->get('amount');
            }
            $extracharge = $this->Extracharge_model->insert_extracharge($data);
            if (count($extracharge) > 0) {
                $res['msg'] = "Successfully Added";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $extracharge;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        
        public function edit_extracharge($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['extra_charge_id_pk'] = $this->input->get('extra_charge_id_pk');
            }
            $extracharge = $this->Extracharge_model->extracharge_data($data['extra_charge_id_pk']);
            if (count($extracharge) > 0) {
                $res['msg'] = "Success";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $extracharge;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);   
        }
        public function update_extracharge($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['extra_charge_id_pk'] = $this->input->get('extra_charge_id_pk');
                $data['trip_id_fk'] = $this->input->get('trip_id_fk');
                $data['charge_detail'] = $this->input->get('charge_detail');
                $data['amount'] = $this->input->get('amount');
            }
            $extracharge = $this->Extracharge_model->update_extracharge($data);
            if (count($extracharge) > 0) {
                $res['msg'] = "Successfully Updated";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $extracharge;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function delete_extracharge($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['extra_charge_id_pk'] = $this->input->get('extra_charge_id_pk');
            }
            $extracharge = $this->Extracharge_model->delete_extracharge($data['extra_charge_id_pk']);
            if (count($extracharge) > 0) {
                $res['msg'] = "Successfully deleted";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $extracharge;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }

        public function insert_local_transfer_price($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['local_transfer_id_pk'] = $this->input->get('local_transfer_id_pk');
                $data['car_id_fk'] = $this->input->get('car_id_fk');
                $data['city_id_fk'] = $this->input->get('city_id_fk');
                $data['company_id_fk'] = $this->input->get('company_id_fk');
                $data['price_per_km'] = $this->input->get('price_per_km');
                $data['base_price'] = $this->input->get('base_price');
                $data['full_half'] = $this->input->get('full_half');
                $data['is_transfer'] = $this->input->get('is_transfer');
            }
            $local_transfer_price = $this->Local_Transfer_price_model->insert_local_transfer_price($data);
            if (count($local_transfer_price) > 0) {
                $res['msg'] = "Successfully Added";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $local_transfer_price;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        
        public function edit_local_transfer_price($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['local_transfer_id_pk'] = $this->input->get('local_transfer_id_pk');
            }
            $local_transfer_price = $this->Local_Transfer_price_model->local_transfer_price_data($data['local_transfer_id_pk']);
            if (count($local_transfer_price) > 0) {
                $res['msg'] = "Success";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $local_transfer_price;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);   
        }
        public function update_local_transfer_price($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['local_transfer_id_pk'] = $this->input->get('local_transfer_id_pk');
                $data['car_id_fk'] = $this->input->get('car_id_fk');
                $data['city_id_fk'] = $this->input->get('city_id_fk');
                $data['company_id_fk'] = $this->input->get('company_id_fk');
                $data['price_per_km'] = $this->input->get('price_per_km');
                $data['base_price'] = $this->input->get('base_price');
                $data['full_half'] = $this->input->get('full_half');
                $data['is_transfer'] = $this->input->get('is_transfer');
            }
            $extraclocal_transfer_priceharge = $this->Local_Transfer_price_model->update_local_transfer_price($data);
            if (count($local_transfer_price) > 0) {
                $res['msg'] = "Successfully Updated";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $local_transfer_price;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function delete_local_transfer_price($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['local_transfer_id_pk'] = $this->input->get('local_transfer_id_pk');
            }
            $local_transfer_price = $this->Local_Transfer_price_model->delete_local_transfer_price($data['local_transfer_id_pk']);
            if (count($local_transfer_price) > 0) {
                $res['msg'] = "Successfully deleted";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $local_transfer_price;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }

        public function insert_outstation_price($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['outstation_price_id_pk'] = $this->input->get('outstation_price_id_pk');
                $data['car_id_fk'] = $this->input->get('car_id_fk');
                $data['city_id_fk'] = $this->input->get('city_id_fk');
                $data['company_id_fk'] = $this->input->get('company_id_fk');
                $data['price_per_km'] = $this->input->get('price_per_km');
            }
            $outstation_price = $this->Outstation_price_model->insert_outstation_price($data);
            if (count($outstation_price) > 0) {
                $res['msg'] = "Successfully Added";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $outstation_price;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        
        public function edit_outstation_price($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['outstation_price_id_pk'] = $this->input->get('outstation_price_id_pk');
            }
            $outstation_price = $this->Outstation_price_model->outstation_price_data($data['outstation_price_id_pk']);
            if (count($outstation_price) > 0) {
                $res['msg'] = "Success";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $outstation_price;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);   
        }
        public function update_outstation_price($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['outstation_price_id_pk'] = $this->input->get('outstation_price_id_pk');
                $data['car_id_fk'] = $this->input->get('car_id_fk');
                $data['city_id_fk'] = $this->input->get('city_id_fk');
                $data['company_id_fk'] = $this->input->get('company_id_fk');
                $data['price_per_km'] = $this->input->get('price_per_km');
            }
            $outstation_price = $this->Outstation_price_model->update_outstation_price($data);
            if (count($outstation_price) > 0) {
                $res['msg'] = "Successfully Updated";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $outstation_price;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
        public function delete_outstation_price($args = array()){
            $benchmarkTimeStar = microtime(1);
            $data = $args;
            if ($data == null) {
                $data['outstation_price_id_pk'] = $this->input->get('outstation_price_id_pk');
            }
            $outstation_price = $this->Outstation_price_model->delete_outstation_price($data['outstation_price_id_pk']);
            if (count($outstation_price) > 0) {
                $res['msg'] = "Successfully deleted";
            } else {
                $res['msg'] = "Sorry!An error Occured";
            }
            $res['data'] = $outstation_price;
            $benchmarkTimeEnd = microtime(1);
            $res['timespan'] = round(1000 * ($benchmarkTimeEnd - $benchmarkTimeStar), 4) . "ms";
            echo json_encode($res);
        }
    }
?>