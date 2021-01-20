<?php

require_once 'Database.php';
require 'vendor/autoload.php';

class MovieList
{
	private $conn;
	function __construct()
	{
		date_default_timezone_set('Europe/Istanbul');
		$conn = new Database();
		$this->conn = $conn->connect();
	}
	function MovieList()
	{
		//SELECT * FROM birinci_tablo INNER JOIN ikinci_tablo ON birinci_tablo.userID=ikinci_tablo.userID
		$statement = $this->conn->prepare("SELECT 
			publishmovie.id,publishmovie.create_at,
			movies.title,movies.year,movies.released,movies.runtime,movies.genre,movies.director,movies.writer,movies.actors,movies.poster,movies.imdbRating,movies.type,movies.plot,
			users.username
			FROM publishmovie 
			INNER JOIN movies ON publishmovie.imdbID=movies.imdbID
			INNER JOIN users ON publishmovie.userId=users.id
			 ORDER BY publishmovie.create_at DESC LIMIT 20");
		$statement->execute();
		$results = $statement->fetchAll(PDO::FETCH_CLASS);



		foreach ($results as $movie) {
			//$movie->publishmovie["create_at"] = $this->timeago($movie->publishmovie["create_at"]);
			$fullDate = explode(" ", $movie->create_at);
			$date = explode("-", $fullDate[0]);

			$createDate = $date[0] . "-" . $date[1] . "-" . $date[2] . " " . $fullDate[1];
			$turkish = new \Westsworld\TimeAgo\Translations\Tr();
			$timeAgo = new Westsworld\TimeAgo($turkish);
			$movie->create_at =  $timeAgo->inWordsFromStrings($createDate);

			
			$statement = $this->conn->prepare("SELECT count(*)	as commentCount	
			FROM comments  WHERE publishMovieId=:publishMovieId");
			$statement->execute(array(
				"publishMovieId" =>  $movie->id,
			));
			$count = $statement->fetchAll(PDO::FETCH_CLASS);
			$movie->commentCount= $count[0]->commentCount;
			

		}


		$movieDetail = (object) array(
			'status'	=> 200,
			'results'	=> $results
		);
		return json_encode((array) $movieDetail);
	}
}
