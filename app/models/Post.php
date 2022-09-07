<?php 
    class Post {
        private $db;

        public function __construct(){
            $this -> db = new Database;
        }

        public function getPosts(){
            $this -> db -> query('SELECT *, 
                                    posts.id as postId,
                                    users.id as userId,
                                    posts.created_at as postCreated,
                                    users.created_at as userCreated
                                    FROM posts
                                    INNER JOIN users 
                                    ON posts.user_id = users.id
                                    ORDER BY posts.created_at DESC
                                    ');

            $results = $this -> db -> resultSet();

            return $results;
        }

        public function savePost($form_data){
            $this -> db -> query('INSERT INTO posts (title, body, meta_title, meta_description, user_id) VALUES(:title, :body, :meta_title, :meta_description, :user_id)');
            //bind values
            $this -> db -> bind(':title', $form_data['title']);
            $this -> db -> bind(':body', $form_data['body']);
            $this -> db -> bind(':meta_title', $form_data['meta_title']);
            $this -> db -> bind(':meta_description', $form_data['meta_description']);
            $this -> db -> bind(':user_id', $form_data['user_id']);

            //execute 
            if($this -> db -> execute()){
                return true;
            }else {
                return false;
            }
        }

        public function getPostById($id){
            $this -> db -> query('SELECT * FROM posts WHERE id = :id');
            $this -> db -> bind(':id', $id);

            $row = $this -> db -> single();

            return $row;
        }

        public function updatePost($form_data){
            $this -> db -> query('UPDATE posts SET title = :title, body = :body, meta_title = :meta_title, meta_description = :meta_description WHERE id = :id');
            //bind values
            $this -> db -> bind(':id', $form_data['id']);
            $this -> db -> bind(':title', $form_data['title']);
            $this -> db -> bind(':body', $form_data['body']);
            $this -> db -> bind(':meta_title', $form_data['meta_title']);
            $this -> db -> bind(':meta_description', $form_data['meta_description']);

            //execute 
            if($this -> db -> execute()){
                return true;
            }else {
                return false;
            }
        }

        public function deletePost($id){
            $this -> db -> query('DELETE FROM posts WHERE id = :id');
            //bind values
            $this -> db -> bind(':id', $id);

            //execute 
            if($this -> db -> execute()){
                return true;
            }else {
                return false;
            }
        }
    }

    


//$this -> db -> query('SELECT * FROM posts');