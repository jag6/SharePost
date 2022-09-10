<?php 
    class User {
        private $db;

        public function __construct(){
            $this -> db = new Database;
        }

        //register user
        public function register($form_data){
            $this -> db -> query('INSERT INTO users (first_name, last_name, email, password) VALUES(:first_name, :last_name, :email, :password)');
            //bind values
            $this -> db -> bind(':first_name', $form_data['first_name']);
            $this -> db -> bind(':last_name', $form_data['last_name']);
            $this -> db -> bind(':email', $form_data['email']);
            $this -> db -> bind(':password', $form_data['password']);

            //execute 
            if($this -> db -> execute()){
                return true;
            }else {
                return false;
            }
        }

        //login user
        public function login($email, $password){
            $this -> db -> query('SELECT * FROM users WHERE email = :email');
            $this -> db -> bind(':email', $email);

            $row = $this -> db -> single();

            $hashed_passoword = $row -> password;
            if(password_verify($password, $hashed_passoword)){
                return $row;
            }else {
                return false;
            }
        }

        //find user by email
        public function findUserByEmail($email){
            $this -> db -> query('SELECT * FROM users WHERE email = :email');
            //bind value
            $this -> db -> bind(':email', $email);

            $row = $this -> db -> single();
            
            //check row
            if($this -> db -> rowCount() > 0){
                return true;
            }else {
                return false;
            }
        }

        //get user by id
        public function getUserById($id){
            $this -> db -> query('SELECT * FROM users WHERE id = :id');
            //bind value
            $this -> db -> bind(':id', $id);

            $row = $this -> db -> single();
            
            return $row;
        }
    }