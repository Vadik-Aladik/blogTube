<?php 

    // require_once "../classes/QueryBuilder.php";
    require_once __DIR__ . '/../classes/QueryBuilder.php';

    class Blog extends QueryBuilder
    {
        public function blogUser()
        {
            return $this->select('blogs', "blogs.id, blogs.title, blogs.content, blogs.created_at, users.login")->innerJoin('users', 'user_id', 'id');
        }
    }

?>