<?php

//===== DATABASE HELPER FUNCTIONS =====//

function fetchRecords($result){
    return mysqli_fetch_array($result);
}

function count_records($result){
    return mysqli_num_rows($result);
}
//===== END DATABASE HELPERS =====//


//===== GENERAL HELPERS =====//

function get_user_name(){
    return isset($_SESSION['username']) ? $_SESSION['username'] : null;
}

//===== END GENERAL HELPERS =====//


//===== AUTHENTICATION HELPERS =====//

function is_admin() {
    if(isLoggedIn()){
        $result = query("SELECT user_role FROM users WHERE user_id=".$_SESSION['user_id']."");
        $row = fetchRecords($result);
        if($row['user_role'] == 'admin'){
            return true;
        }else {
            return false;
        }
    }
    return false;
}

//===== END AUTHENTICATION HELPERS =====//

//===== USER SPECIFIC HELPERS=====//

//return or select the posts for the user that are loggedIn
function get_all_user_posts(){
    return query("SELECT * FROM posts WHERE user_id=".loggedInUserId()."");
}

function get_all_posts_user_comments(){
    return query("SELECT * FROM posts
    INNER JOIN comments ON posts.post_id = comments.comment_post_id
    WHERE user_id=".loggedInUserId()."");
//posts = name of the table
    //comments = name of the table
}

function get_all_user_categories(){
    return query("SELECT * FROM categories WHERE user_id=".loggedInUserId()."");
}

// get all the  publish post chart for the user query 
function get_all_user_published_posts(){
    return query("SELECT * FROM posts WHERE user_id=".loggedInUserId()." AND post_status='published'");
}

// get all the  draft chart for the user query
function get_all_user_draft_posts(){
    return query("SELECT * FROM posts WHERE user_id=".loggedInUserId()." AND post_status='draft'");
}
	//approved chart comment query
function get_all_user_approved_posts_comments(){
    return query("SELECT * FROM posts
    INNER JOIN comments ON posts.post_id = comments.comment_post_id
    WHERE user_id=".loggedInUserId()." AND comment_status='approved'");
}
//unapproved chart comment query
function get_all_user_unapproved_posts_comments(){
    return query("SELECT * FROM posts
    INNER JOIN comments ON posts.post_id = comments.comment_post_id
    WHERE user_id=".loggedInUserId()." AND comment_status='unapproved'");
}



//===== END USER SPECIFIC HELPERS=====//



function isLoggedIn(){
if(isset($_SESSION['email'])){
return true;
}
return false;
}

//function loggedin userid
function loggedInUserId(){

if(isLoggedIn()){
$result = query("SELECT * FROM users WHERE email ='".$_SESSION['email']."'");
confirmQuery($result);
$user = mysqli_fetch_array($result);
return mysqli_num_rows($result) >= 1 ? $user['id'] : false;
}
return false;
}

//user liked this course function
function userLikedThisCourse($course_id=''){
$result = query("SELECT * FROM likes WHERE user_id=" .loggedInUserId() . " AND course_id={$course_id}");
confirmQuery($result);
return mysqli_num_rows($result) >= 1 ? true : false;
}

//geting the post likes
function getCourselikes($course_id){

$result = query("SELECT * FROM likes WHERE course_id=$course_id");
confirmQuery($result);
echo mysqli_num_rows($result);

}


//user online function
function user_online(){


if(isset($_GET['onlineusers'])){



global $connections;

if(!$connections){

session_start();
include("../functions/db.php ");
$session = session_id();//will have the id of any users that loggedin into the admin
$time = time();
$time_out_in_seconds = 05;
$time_out = $time - $time_out_in_seconds;

$query = "SELECT * FROM users_online WHERE session = '$session' ";
$send_query = mysqli_query($connections,$query);
$count = mysqli_num_rows($send_query);


if($count == NULL){
//if a new user logged_in the we insert time & session
mysqli_query($connections, "INSERT INTO users_online(session, time) VALUES('$session','$time')");

}else{
//if the user is not new the user has been there before

mysqli_query($connections, "UPDATE users_online SET time = '$time' WHERE session = '$session'");


}

$users_online_query = mysqli_query($connections,"SELECT * FROM users_online WHERE time > '$time_out'");

echo $count_user =  mysqli_num_rows($users_online_query);



}


}// the get request isset



}

user_online();










function ConfirmQuery($result){
global $connections;

if(!$result)
{
die("QUERY FAILED " .mysqli_error($connections));	

}
}



function insert_categories()

{
global $connections;

if(isset($_POST['submit']))
{

$cat_title = $_POST['cat_title'];

if($cat_title == "" ||  empty($cat_title)){
echo "This field should not be empty ";

}
else 
{
$query = "INSERT INTO categories(cat_title) ";
$query .= "VALUES('{$cat_title}') ";	
$create_category_query = mysqli_query($connections,$query);
if(!$create_category_query){
die('QUERY FAILED' . mysqli_error($connections));
}
else{
echo "Category Added ";	
}
}

}

}



function findAllCategories() {

global $connections;

$query = "SELECT * FROM categories ";
$select_categories = mysqli_query($connections,$query);


while ($row = mysqli_fetch_assoc($select_categories)){
$cat_title = $row['cat_title'];
$cat_id = $row['cat_id'];

echo "<tr>";
echo "<td>{$cat_id}</td>";
echo "<td>{$cat_title}</td>";

echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";

echo "</tr>";
}	
}


function deleteCategories(){

global $connections;

if(isset($_GET['delete'])){
$the_cat_id = $_GET['delete'];
$query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
$delete_query = mysqli_query($connections,$query);
header("Location: categories.php");
}


}





?>