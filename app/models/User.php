<?php 
    class User {
        private $db;

        public function __construct(){
            $this -> db = new Database;
        }

        //register user
        public function register($form_data){
            $this -> db -> query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
            //bind values
            $this -> db -> bind(':name', $form_data['name']);
            $this -> db -> bind(':email', $form_data['email']);
            $this -> db -> bind(':password', $form_data['password']);

            //execute 
            if($this -> db -> execute()){
                return true;
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
    }