<?php 
    session_start();

    //flash message helper
    //example - flash('register_success', 'You are now registered');
    //display in view - echo flash('register_success');
    function flash($first_name = '', $message = '', $class = 'alert-success'){
        if(!empty($first_name)){
            if(!empty($message) && empty($_SESSION[$first_name])){
                if(!empty($_SESSION[$first_name])){
                    unset($_SESSION[$first_name]);
                }

                if(!empty($_SESSION[$first_name. '_class'])){
                    unset($_SESSION[$first_name. '_class']);
                }

                $_SESSION[$first_name] = $message;
                $_SESSION[$first_name . '_class'] = $class;
            }elseif(empty($message) && !empty($_SESSION[$first_name])){
                $class = !empty($_SESSION[$first_name. '_class']) ? $_SESSION[$first_name. '_class'] : '';
                echo '<div class ="'.$class.'" id="msg-flash">'.$_SESSION[$first_name].'</div>';
                unset($_SESSION[$first_name]);
                unset($_SESSION[$first_name. '_class']);
            }
        }
    }

    function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
            return true;
        }else {
            return false;
        }
    }