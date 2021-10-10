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

//Blog Post Query
$result = $post->read();

//Get Row Count
$num = $result->rowCount();

//Check if there is any posts
if ($num > 0) {
    //posts array
    $posts_arr= array();
    $posts_arr['data']=array();

    while ($row = $result->fetch(PDO:: FETCH_ASSOC)) {
        extract($row);

        $post_item= array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'created_at' => $created_at

        );
        //Push to 'data'
        array_push($posts_arr['data'], $post_item);
    }

    //Convert to JSON&Output
    echo json_encode($posts_arr);
}else {
    //If no posts exist
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}