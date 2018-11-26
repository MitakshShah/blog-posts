<?php 

class Post {
    private $db;

    public function __construct(){
        $this->db = new Db;
    }

    public function getPosts() {
        $this->db->query('SELECT *, posts.id as postId, users.id as userId, 
                            posts.created_at as post_created, users.created_at as user_created 
                            FROM posts INNER JOIN users ON posts.user_id = users.id
                            ORDER BY posts.created_at DESC');
        $results = $this->db->getList();
        return $results;
    }

    public function addPosts($data){
        $this->db->query("INSERT INTO posts (title,body,user_id) VALUES (:title,:body,:user_id)");
        // Bind values
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':body',$data['body']);
        $this->db->bind(':user_id',$data['user_id']);

        // Execute Query
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getPostsById($id) {
        $this->db->query("SELECT * FROM posts where id = :id");
        $this->db->bind(':id',$id);
        $row = $this->db->getItem();
        return $row;
    }

    public function updatePosts($data){
        $this->db->query("UPDATE posts SET title= :title, body = :body WHERE id = :id");
        // Bind values
        $this->db->bind(':id',$data['id']);
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':body',$data['body']);

        // Execute Query
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}