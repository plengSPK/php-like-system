<?php

require 'config/server.php';

$user_id = 1;

if(isset($_POST['action'])){
    $post_id = $_POST['post_id'];
    $action = $_POST['action'];

    switch($action){
        case 'like':
            $sql = "INSERT INTO rating_info (post_id, user_id, rating_action) 
                    VALUES ($post_id, $user_id, '$action')
                    ON DUPLICATE KEY UPDATE rating_action='like'";
            break;
        case 'dislike':
            $sql = "INSERT INTO rating_info (post_id, user_id, rating_action) 
                    VALUES ($post_id, $user_id, '$action')
                    ON DUPLICATE KEY UPDATE rating_action='dislike'";
            break;
        case 'unlike':
            $sql = "DELETE FROM rating_info WHERE user_id=$user_id AND post_id=$post_id";
            break;
        case 'undislike':
            $sql = "DELETE FROM rating_info WHERE user_id=$user_id AND post_id=$post_id";
            break;
    }

    // execute query
    $conn->query($sql);

    // return number of likes
    echo getRating($post_id);

    exit();
}

function getRating($postID){
    
    $rating = array();

    $likes = GetLikes($postID);
    $dislikes = GetDislikes($postID);

    $rating = [
        'likes' => $likes,
        'dislikes' => $dislikes
    ];

    return json_encode($rating);

}

function GetLikes($postID){
    global $conn;
    
    $like_result = $conn->query("SELECT COUNT(*) FROM rating_info WHERE post_id=$postID AND rating_action='like'");
    $likes = $like_result->fetch_array();
    
    return $likes[0];
}

function GetDislikes($postID){
    global $conn;
    
    $dislike_result = $conn->query("SELECT COUNT(*) FROM rating_info WHERE post_id=$postID AND rating_action='dislike'");
    $dislikes = $dislike_result->fetch_array();

    return $dislikes[0];
}

function userLiked($postID){
    global $conn;
    global $user_id;
    
    $like_result = $conn->query("SELECT * FROM rating_info WHERE user_id=$user_id AND post_id=$postID AND rating_action='like'");
    
    if($like_result->num_rows > 0){
        return true;
    }else{
        return false;
    }
}

function userDisliked($postID){
    global $conn;
    global $user_id;
    
    $dislike_result = $conn->query("SELECT * FROM rating_info WHERE user_id=$user_id AND post_id=$postID AND rating_action='dislike'");
    
    if($dislike_result->num_rows > 0){
        return true;
    }else{
        return false;
    }
}