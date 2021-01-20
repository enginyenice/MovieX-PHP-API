<?php

require_once 'Curl.php';
require_once 'Database.php';
class Movies
{
	private $apiUrl;
	private $NoImage;
	private $conn;
	function __construct()
	{
		$this->apiUrl = "http://www.omdbapi.com/?apikey=8a988f2&";
        $this->NoImage= "http://moviex.enginyenice.com/assets/resimYok.jpg";
		$conn= new Database();
		$this->conn = $conn->connect();
	}

	function getMovie($title){
		$controlTitle = $title;
		$apiTitle = $title;
		$search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü','%20');
		$replace = array('c','c','g','g','i','i','o','o','s','s','u','u',' '); 

		

		
		$controlTitle = str_replace($search,$replace,$title);
		$controlDatabase = $this->controlDatabase($controlTitle);


		$movieDetail = (object) array(
			'status'	=> 301,
		);



		if($controlDatabase == 0){
			$curl = new Curl();
			$data = $curl->getCurl($this->apiUrl."t=".$apiTitle);
			$movie = json_decode($data);

			if(empty($movie->Error))
			{
				$movieDetail = (object) array(
					'status'	=> 200,
					'result'	=> (object) array(
						'title'		=> $movie->Title,
						'year'		=> $movie->Year,
						'released'	=> $movie->Released,
						'runtime'	=> $movie->Runtime,
						'genre'		=> $movie->Genre,
						'director'	=> $movie->Director,
						'writer'	=> $movie->Writer,
						'actors'	=> $movie->Actors,
						'poster'	=> ($movie->Poster == "N/A")? $this->NoImage : $movie->Poster,
						'imdbRating'=> $movie->imdbRating,
						'type'		=> $movie->Type,
						'plot'		=> $movie->Plot,
						'imdbID'	=> $movie->imdbID,
					));
				$this->addDatabase($movieDetail);
			}
		} else {
			$movieDetail = (object) array(
				'status'	=> 200,
				'result'	=> $this->getDatabase($controlTitle)
			);
		}





		return json_encode((array) $movieDetail);
	}
	function addDatabase($movieDetail){

		$sql = "INSERT INTO movies (title, year, released,runtime,genre,director,writer,actors,poster,imdbRating,type,plot,imdbID) VALUES (:title,:year,:released,:runtime,:genre,:director,:writer,:actors,:poster,:imdbRating,:type,:plot,:imdbID)";
		$query = $this->conn->prepare($sql);
		$status = $query->execute(array(
			"title"		=> $movieDetail->result->title,
			"year"		=> $movieDetail->result->year,
			"released"	=> $movieDetail->result->released,
			"runtime"	=> $movieDetail->result->runtime,
			"genre"		=> $movieDetail->result->genre,
			"director"	=> $movieDetail->result->director,
			"writer"	=> $movieDetail->result->writer,
			"actors"	=> $movieDetail->result->actors,
			"poster"	=> $movieDetail->result->poster,
			"imdbRating"=> $movieDetail->result->imdbRating,
			"type"		=> $movieDetail->result->type,
			"plot"		=> $movieDetail->result->plot,
			"imdbID"	=> $movieDetail->result->imdbID,
		));
	}
	function controlDatabase($title){
		$statement = $this->conn->prepare("SELECT * FROM movies WHERE title=?");
		$statement->execute([$title]); 
		$number_of_rows = $statement->fetchColumn(); 
		return $number_of_rows;
	}
	function getDatabase($title){
		$statement = $this->conn->prepare("SELECT title, year, released,runtime,genre,director,writer,actors,poster,imdbRating,type,plot,imdbID FROM movies WHERE title=?");
		$statement->execute([$title]); 
		$results = $statement->fetchAll(PDO::FETCH_CLASS);

		return $results[0];

	}
}