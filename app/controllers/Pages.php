<?php 
    class Pages extends Controller {
        public function __construct(){
            $this -> userModel = $this -> model('User');
            $this -> postModel = $this -> model('Post');
        }

        public function index(){
            $data = [
                'title' => 'SharePost',  
                'description' => 'Welcome to your blogging parardise. Here you will find millions of interesting articles perfectly tailored for your reading pleasure and needs',
                'meta_title' => 'SharePost: Your Blogtopia',
                'meta_description' => 'Welcome to your blogging parardise. Here you will find millions of interesting articles perfectly tailored for your reading pleasure and needs'
            ];
            $this -> view('pages/index', $data);
        }

        public function about(){
            $data = [
                'title' => 'About',
                'description' => 'This is where I talk about me. Me me me!!!',
                'meta_title' => 'About',
                'meta_description' => 'This is where I talk about me. Me me me!!!'
            ];
            $this -> view('pages/about', $data);
        }

        public function faq(){
            $data = [
                'title' => 'FAQ',
                'description' => 'You have questions, we have answers',
                'meta_title' => 'FAQ',
                'meta_description' => 'You have questions, we have answers'
            ];
            $this -> view('pages/about', $data);
        }

        public function register(){
            //check for posts
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $data = [
                    'title' => 'Create an Account',
                    'description' => 'Please fill out this form to register your new account',
                    'meta_title' => 'Register',
                    'meta_description' => 'Please fill out this form to register your new account'
                ];

                //process form
                
                //sanitize post data
                $_POST = filter_input_array(htmlspecialchars(INPUT_POST));

                $form_data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'name_error' => '',
                    'email_error' => '',
                    'password_error' => '',
                    'confirm_password_error' => ''
                ];

                //validate name
                if(empty($form_data['name'])){
                    $form_data['name_error'] = 'Please enter name';
                }

                //validate email
                if(empty($form_data['email'])){
                    $form_data['email_error'] = 'Please enter email';
                }else {
                    //check email
                    if($this -> userModel -> findUserByEmail($form_data['email'])){
                        $form_data['email_error'] = 'Email already taken';
                    }
                }

                //validate password
                if(empty($form_data['password'])){
                    $form_data['password_error'] = 'Please enter password';
                }elseif(strlen($form_data['password']) < 8){
                    $form_data['password_error'] = 'Password must be at least 8 characters';
                }

                //validate confirm password
                if(empty($form_data['confirm_password'])){
                    $form_data['confirm_password_error'] = 'Please confirm password';
                }else {
                    if($form_data['password'] != $form_data['confirm_password']){
                        $form_data['confirm_password_error'] = 'Passwords do not match';
                    }
                }

                //make sure errors are empty
                if(empty($form_data['email_error']) && empty($form_data['name_error']) && empty($form_data['password_error']) && empty($form_data['confirm_password_error'])){
                    //validated
                    
                    //hash password
                    $form_data['password'] = password_hash($form_data['password'], PASSWORD_DEFAULT);

                    //register user
                    if($this -> userModel -> register($form_data)){
                        flash('register_success', 'Success! You are now registered and can log in');
                        redirect('/login');
                    }else {
                        die('Something went wrong');
                    }
                }else {
                    //load view with errors
                    $this -> view('pages/register', $data, $form_data);
                }

            }else {
                //initialize form
                $data = [
                    'title' => 'Create an Account',
                    'description' => 'Please fill out this form to register your new account',
                    'meta_title' => 'Register',
                    'meta_description' => 'Please fill out this form to register your new account'
                ];

                $form_data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_error' => '',
                    'email_error' => '',
                    'password_error' => '',
                    'confirm_password_error' => ''
                ];

                //load view
                $this -> view('pages/register', $data, $form_data);
            }
        }

        public function login(){
            $data = [
                'title' => 'Login',
                'description' => 'Welcome Back!',
                'meta_title' => 'Login',
                'meta_description' => 'Welcome Back! Please login'
            ];
            //check for posts
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //process form

                //sanitize post data
                $_POST = filter_input_array(htmlspecialchars(INPUT_POST));

                $form_data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_error' => '',
                    'password_error' => ''
                ];

                //validate email
                if(empty($form_data['email'])){
                    $form_data['email_error'] = 'Please enter email';
                }

                //validate password
                if(empty($form_data['password'])){
                    $form_data['password_error'] = 'Please enter password';
                }elseif(strlen($form_data['password']) < 8){
                    $form_data['password_error'] = 'Password must be at least 8 characters';
                }

                //check for user/email
                if($this -> userModel -> findUserByEmail($form_data['email'])){
                    //user found
                }else {
                    //user not found
                    $form_data['email_error'] = 'No user found';
                }

                //make sure errors are empty
                if(empty($form_data['email_error']) && empty($form_data['password_error'])){
                    //validated
                    //check and set logged in user
                    $loggedInUser = $this -> userModel -> login($form_data['email'], $form_data['password']);
                    if($loggedInUser){
                        //create session
                        $this -> createUserSession($loggedInUser);
                    }else {
                        $form_data['password_error'] = 'Password incorrect';
                        $this -> view('pages/login', $data, $form_data);
                    }
                }else {
                    //load view with errors
                    $this -> view('pages/login', $data, $form_data);
                }

            }else {
                //initialize form
                $data = [
                    'title' => 'Login',
                    'description' => 'Welcome Back!',
                    'meta_title' => 'Login',
                    'meta_description' => 'Welcome Back! Please login'
                ];

                $form_data = [
                    'email' => '',
                    'password' => '',
                    'email_error' => '',
                    'password_error' => ''
                ];

                //load view
                $this -> view('pages/login', $data, $form_data);
            }
        }

        public function createUserSession($user){
            $_SESSION['user_id'] = $user -> id;
            $_SESSION['user_name'] = $user -> name;
            $_SESSION['user_email'] = $user -> email;
            redirect('posts');
        }

        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_email']);
            session_destroy();
            redirect('login');
        }

        public function posts(){
            if(!isLoggedIn()){
                redirect('login');
            }

            $posts = $this -> postModel -> getPosts();

            $data = [
                'description' => 'A collection of all my posts',
                'meta_title' => 'Posts',
                'meta_description' => 'A collection of all my posts',
                'posts' => $posts
            ];

            $this -> view('pages/posts/index', $data);
        }

        public function new(){
            if(!isLoggedIn()){
                redirect('login');
            }

            $data = [
                'description' => 'Write a new post with this form',
                'meta_title' => 'New Post',
                'meta_description' => 'Write a new post'
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //sanitize post array
                $_POST = filter_input_array(htmlspecialchars(INPUT_POST));

                $form_data = [
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_error' => '',
                    'body_error' => ''
                ];

                //validate title
                if(empty($form_data['title'])){
                    $form_data['title_error'] = 'Please enter title';
                }

                //validate body
                if(empty($form_data['body'])){
                    $form_data['body_error'] = 'Please enter body text';
                }

                //make sure errors are empty
                if(empty($form_data['title_error']) && empty($form_data['body_error'])){
                    //validated
                    if($this -> postModel -> savePost($form_data)){
                        flash('post_message', 'Post Saved!');
                        redirect('posts');
                    }else {
                        die('Something went wrong');
                    }

                }else {
                    //load view with errors
                    $this -> view('pages/posts/new', $data, $form_data);
                }

            }else {
                $form_data = [
                    'title' => '',
                    'body' => '',
                    'title_error' => '',
                    'body_error' => ''
                ];
            }
            $this -> view('pages/posts/new', $data, $form_data);
        }
    }