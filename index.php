<?php 

require_once 'Libraries/Movies.php';
require_once 'Libraries/PublishMovie.php';
require_once 'Libraries/MovieList.php';
require_once 'Libraries/Comments.php';
require_once 'Libraries/Users.php';
header('Content-Type: application/json');
date_default_timezone_set('Europe/Istanbul');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

if(isset($_GET["t"]))
{
	$movie = new Movies();
	$search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
	$replace = array('c','c','g','g','i','i','o','o','s','s','u','u','%20'); 
	$new_text = str_replace($search,$replace,$_GET["t"]);

	echo $movie->getMovie($new_text);
}
if(isset($_GET["userId"]) && isset($_GET["publishMovie"])){
	$userId = $_GET["userId"];
	$imdbId = $_GET["publishMovie"];
	$publish = new PublishMovie();
	echo $publish->Publish($userId,$imdbId);
}
if(isset($_GET["home"])){
	$movieList = new MovieList();
	echo $movieList->MovieList();

}
if(isset($_GET["comments"])){
	$commentList = new Comments();
	echo $commentList->getComments($_GET["comments"]);

}
if(isset($_GET["getUsername"])){
	 $user = new Users();
	 echo $user->getUsername($_GET["getUsername"]);
	 
}

if(isset($_POST["movieID"]) && isset($_POST["userId"]) && isset($_POST["comment"])){

	$createComment = new Comments();
	echo $createComment->setComments($_POST["movieID"],$_POST["userId"],$_POST["comment"]);
	
}

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["login"])) {
	$user = new Users();
    echo $user->getUserCount($_POST["username"], $_POST["password"]);
}
if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["register"])) {
    $user = new Users();
    echo $user->SetUser($_POST["username"], $_POST["password"]);
}
if (isset($_POST["userId"]) && isset($_POST["password"]) && isset($_POST["edit"])) {
    $user = new Users();
    echo $user->EditUser($_POST["userId"], $_POST["password"]);
}


//var_dump($_POST);
?>