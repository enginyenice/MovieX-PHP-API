<?php
require_once 'Database.php';
class PublishMovie
{
	private $conn;
	function __construct()
	{
		$conn= new Database();
		$this->conn = $conn->connect();
	}

	function Publish($userId,$imdbId){

		$insertStatus = (object) array();
		if($this->getUserIdCount($userId) > 0) {
		$insertStatus = (object) array(
			'status'	=> 300, );
		$sql = "INSERT INTO publishmovie (userId,imdbID) VALUES (:userId,:imdbID)";
		$query = $this->conn->prepare($sql);
		$status = $query->execute(array(
			"userId"		=> $userId,
			"imdbID"		=> $imdbId,
		));

		if($status == true){
			$insertStatus = (object) array(
				'status'	=> 200, );
		}
	} else {
		$insertStatus = (object) array(
			'status'	=> 400,
		);
	}

		return json_encode((array) $insertStatus);


	}

	public function getUserIdCount($userId)
    {
        $statement = $this->conn->prepare("SELECT * FROM users WHERE id=:id");
        $statement->execute(array(
            "id" => $userId,
        ));
        $number_of_rows = $statement->fetchColumn();
        return $number_of_rows;
    }
}