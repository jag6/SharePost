<?php 
    class Pages extends Controller {
        public function __construct(){
            $this -> userModel = $this -> model('User');
            $this -> postModel = $this -> model('Post');
        }

        public function index(){
            $meta_data = [
                'meta_title' => 'SharePost: Your Blogtopia',
                'meta_description' => 'Welcome to your blogging parardise. Here you will find millions of interesting articles perfectly tailored for your reading pleasure and needs'
            ];

            $data = [
                'title' => 'SharePost',  
                'description' => 'Welcome to your blogging parardise. Here you will find millions of interesting articles perfectly tailored for your reading pleasure and needs'
            ];
            $this -> view('pages/index', $meta_data, $data);
        }

        public function about(){
            $meta_data = [
                'meta_title' => 'About',
                'meta_description' => 'This is where I talk about me. Me me me!!!'
            ];

            $data = [
                'title' => 'About',
                'description' => 'This is where I talk about me. Me me me!!!'
            ];

            $this -> view('pages/about', $meta_data, $data);
        }

        public function faq(){
            $meta_data = [
                'meta_title' => 'FAQ',
                'meta_description' => 'You have questions, we have answers'
            ];

            $data = [
                'title' => 'FAQ',
                'description' => 'You have questions, we have answers'
            ];
            $this -> view('pages/about', $meta_data, $data);
        }

        public function register(){
            //check for posts
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $meta_data = [
                    'meta_title' => 'Register',
                    'meta_description' => 'Please fill out this form to register your new account'
                ];

                $data = [
                    'title' => 'Create an Account',
                    'description' => 'Please fill out this form to register your new account',
                ];

                //process form
                
                //sanitize post data
                $_POST = filter_input_array(htmlspecialchars(INPUT_POST));

                $form_data = [
                    'first_name' => trim($_POST['first_name']),
                    'last_name' => trim($_POST['last_name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'first_name_error' => '',
                    'last_name_error' => '',
                    'email_error' => '',
                    'password_error' => '',
                    'confirm_password_error' => ''
                ];

                //validate name
                if(empty($form_data['first_name'])){
                    $form_data['first_name_error'] = 'Please enter first name';
                }

                //validate name
                if(empty($form_data['last_name'])){
                    $form_data['last_name_error'] = 'Please enter last name';
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
                if(empty($form_data['email_error']) && empty($form_data['first_name_error']) && empty($form_data['last_name_error']) && empty($form_data['password_error']) && empty($form_data['confirm_password_error'])){
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
                    $this -> view('pages/register', $meta_data, $data, $form_data);
                }

            }else {
                //initialize form
                $meta_data = [
                    'meta_title' => 'Register',
                    'meta_description' => 'Please fill out this form to register your new account'
                ];   

                $data = [
                    'title' => 'Create an Account',
                    'description' => 'Please fill out this form to register your new account',
                ];

                $form_data = [
                    'first_name' => '',
                    'last_name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'first_name_error' => '',
                    'last_name_error' => '',
                    'email_error' => '',
                    'password_error' => '',
                    'confirm_password_error' => ''
                ];

                //load view
                $this -> view('pages/register', $meta_data, $data, $form_data);
            }
        }

        public function login(){
            $meta_data = [
                'meta_title' => 'Login',
                'meta_description' => 'Welcome Back! Please login'
            ];

            $data = [
                'title' => 'Login',
                'description' => 'Welcome Back!'
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
                        $this -> view('pages/login', $meta_data, $data, $form_data);
                    }
                }else {
                    //load view with errors
                    $this -> view('pages/login', $meta_data, $data, $form_data);
                }

            }else {
                //initialize form
                $meta_data = [
                    'meta_title' => 'Login',
                    'meta_description' => 'Welcome Back! Please login'
                ];
    
                $data = [
                    'title' => 'Login',
                    'description' => 'Welcome Back!',
                ];

                $form_data = [
                    'email' => '',
                    'password' => '',
                    'email_error' => '',
                    'password_error' => ''
                ];

                //load view
                $this -> view('pages/login', $meta_data, $data, $form_data);
            }
        }

        public function createUserSession($user){
            $_SESSION['user_id'] = $user -> id;
            $_SESSION['user_name'] = $user -> first_name;
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

            $meta_data = [
                'meta_title' => 'Posts',
                'meta_description' => 'A collection of all my posts',
            ];

            $data = [
                'description' => 'A collection of all my posts',
                'posts' => $posts
            ];

            $this -> view('pages/posts/index', $meta_data, $data);
        }

        public function new(){
            if(!isLoggedIn()){
                redirect('login');
            }

            $meta_data = [
                'meta_title' => 'New Post',
                'meta_description' => 'Write a new post'
            ];

            $data = [
                'description' => 'Write a new post with this form'
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //sanitize post array
                $_POST = filter_input_array(htmlspecialchars(INPUT_POST));

                $form_data = [
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'meta_title' => trim($_POST['meta_title']),
                    'meta_description' => trim($_POST['meta_description']),
                    'user_id' => $_SESSION['user_id'],
                    'title_error' => '',
                    'body_error' => '',
                    'meta_title_error' => '',
                    'meta_description_error' => ''
                ];

                //validate title
                if(empty($form_data['title'])){
                    $form_data['title_error'] = 'Please enter title';
                }

                //validate body
                if(empty($form_data['body'])){
                    $form_data['body_error'] = 'Please enter body text';
                }

                //validate meta_title
                if(empty($form_data['meta_title'])){
                    $form_data['meta_title_error'] = 'Please enter metadata title';
                }

                //validate meta_description
                if(empty($form_data['meta_description'])){
                    $form_data['meta_description_error'] = 'Please enter metadata description';
                }

                //make sure errors are empty
                if(empty($form_data['title_error']) && empty($form_data['body_error']) && empty($form_data['meta_title_error']) && empty($form_data['meta_description_error'])){
                    //validated
                    if($this -> postModel -> savePost($form_data)){
                        flash('post_message', 'Post Saved!');
                        redirect('posts');
                    }else {
                        die('Something went wrong');
                    }

                }else {
                    //load view with errors
                    $this -> view('pages/posts/new', $meta_data, $data, $form_data);
                }

            }else {
                $meta_data = [
                    'meta_title' => 'New Post',
                    'meta_description' => 'Write a new post'
                ];
    
                $data = [
                    'description' => 'Write a new post with this form',
                ];

                $form_data = [
                    'title' => '',
                    'body' => '',
                    'meta_title' => '',
                    'meta_description' => '',
                    'user_id' => $_SESSION['user_id'],
                    'title_error' => '',
                    'body_error' => '',
                    'meta_title_error' => '',
                    'meta_description_error' => ''
                ];
            }
            $this -> view('pages/posts/new', $meta_data, $data, $form_data);
        }

        public function edit($id){
            if(!isLoggedIn()){
                redirect('login');
            }

            $meta_data = [
                'meta_title' => 'Edit Post',
                'meta_description' => 'Edit your posts here'
            ];

            $data = [
                'title' => 'Edit Post'
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //sanitize post array
                $_POST = filter_input_array(htmlspecialchars(INPUT_POST));

                $form_data = [
                    'id' => $id,
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'meta_title' => trim($_POST['meta_title']),
                    'meta_description' => trim($_POST['meta_description']),
                    'user_id' => $_SESSION['user_id'],
                    'title_error' => '',
                    'body_error' => '',
                    'meta_title_error' => '',
                    'meta_description_error' => ''
                ];

                //validate title
                if(empty($form_data['title'])){
                    $form_data['title_error'] = 'Please enter title';
                }

                //validate body
                if(empty($form_data['body'])){
                    $form_data['body_error'] = 'Please enter body text';
                }

                //validate meta_title
                if(empty($form_data['meta_title'])){
                    $form_data['meta_title_error'] = 'Please enter metadata title';
                }

                //validate meta_description
                if(empty($form_data['meta_description'])){
                    $form_data['meta_description_error'] = 'Please enter metadata description';
                }

                //make sure errors are empty
                if(empty($form_data['title_error']) && empty($form_data['body_error']) && empty($form_data['meta_title_error']) && empty($form_data['meta_description_error'])){
                    //validated
                    if($this -> postModel -> updatePost($form_data)){
                        flash('post_message', 'Post Saved!');
                        redirect('posts');
                    }else {
                        die('Something went wrong');
                    }

                }else {
                    //load view with errors
                    $this -> view('pages/posts/edit', $meta_data, $data, $form_data);
                }

            }else {
                //get existing post from model
                $post = $this -> postModel -> getPostById($id);

                //check for owner
                if($post -> user_id != $_SESSION['user_id']){
                    redirect('posts');
                }

                $form_data = [
                    'id' => $id,
                    'title' => $post -> title,
                    'body' => $post -> body,
                    'meta_title' => $post -> meta_title,
                    'meta_description' => $post -> meta_description,
                    'title_error' => '',
                    'body_error' => '',
                    'meta_title_error' => '',
                    'meta_description_error' => ''
                ];
            }
            $this -> view('pages/posts/edit', $meta_data, $data, $form_data);
        }

        public function show($id){
            if(!isLoggedIn()){
                redirect('login');
            }

            $meta_data = '';

            $post = $this -> postModel -> getPostById($id);
            $user = $this -> userModel -> getUserById($post -> user_id);

            $data = [
                'post' => $post,
                'user' => $user
            ];
            
            $this -> view('pages/posts/show', $meta_data, $data);
        }

        public function delete($id){
            if(!isLoggedIn()){
                redirect('login');
            }

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //get existing post from model
                $post = $this -> postModel -> getPostById($id);

                //check for owner
                if($post -> user_id != $_SESSION['user_id']){
                    redirect('posts');
                }

                if($this -> postModel -> deletePost($id)){
                    flash('post_message', 'Post Deleted');
                    redirect('posts');
                }else {
                    die('Something went wrong');
                }
            }else {
                redirect('posts');
            }
        }
    }