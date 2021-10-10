<?php
//Headers 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

//DB Instantiation and connection
$database = new Database();
$db= $database->connect();

//Blog Post Instantiation
$post = new Post($db);

//Get id
$post->id= isset($_GET['id']) ? $_GET['id'] : die();

//Get post
$post->read_single();

//Create arr
$post_arr= array(
    'id' =>$post->id,
    'title' =>$post-> $title,
    'body' =>$post->$body,
    'author' =>$post-> $author,
    'category_id' =>$post-> $category_id,
    'created_at' =>$post-> $created_at
);

//Convert to JSON
print_r(json_encode($post_arr));

