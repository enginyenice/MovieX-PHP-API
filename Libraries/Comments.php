<?php
require_once 'Database.php';
require 'vendor/autoload.php';
class Comments
{
    private $conn;
    function __construct()
    {
        date_default_timezone_set('Europe/Istanbul');
        $conn = new Database();
        $this->conn = $conn->connect();
    }
    function getComments($id)
    {
        $statement = $this->conn->prepare("SELECT 
        comments.comment, comments.create_at,users.username
        FROM comments 
        INNER JOIN publishmovie ON comments.publishMovieId=publishmovie.id
        INNER JOIN users ON comments.userId=users.id
        WHERE publishmovie.id=:id
         ORDER BY comments.create_at DESC");
        $statement->execute(array(
            "id"    => $id
        ));
        $results = $statement->fetchAll(PDO::FETCH_CLASS);

        if (!empty($results)) {
            

            foreach ($results as $comment) {
                $fullDate = explode(" ", $comment->create_at);
                $date = explode("-", $fullDate[0]);
    
                $createDate = $date[0] . "-" . $date[1] . "-" . $date[2] . " " . $fullDate[1];
                $turkish = new \Westsworld\TimeAgo\Translations\Tr();
                $timeAgo = new Westsworld\TimeAgo($turkish);
                $comment->create_at =  $timeAgo->inWordsFromStrings($createDate);
    
                
    
            }

        }







        
        $movieDetail = (object) array(
            'status'    => 200,
            'results'    => $results
        );
        return json_encode((array) $movieDetail);
    }
    public function MovieCount($movieID)
    {
        $statement = $this->conn->prepare("SELECT count(*)	as movieCount	
        FROM publishmovie  WHERE id=:id");
        $statement->execute(array(
            "id" =>  $movieID,
        ));
        $movieCount = $statement->fetchAll(PDO::FETCH_CLASS);
        return $movieCount[0]->movieCount;


    }
    public function UserCount($userId)
    {
        $statement = $this->conn->prepare("SELECT count(*)	as userCount	
        FROM users  WHERE id=:id");
        $statement->execute(array(
            "id" =>  $userId,
        ));
        $userCount = $statement->fetchAll(PDO::FETCH_CLASS);
        return $userCount[0]->userCount;
    }
    public function setComments($movieID,$userId,$comment)
    {

        $returnStatus = array();
        if($this->UserCount($userId) > 0 && $this->MovieCount($movieID) > 0 && $comment != "undefined"){
            $sql = "INSERT INTO comments (publishMovieId,userId,comment) VALUES (:publishMovieId,:userId,:comment)";
            $query = $this->conn->prepare($sql);
            $status = $query->execute(array(
               "publishMovieId" => $movieID,
               "userId"         => $userId,
               "comment"        => $comment
            ));
            
            if($status){
                $returnStatus["status"] = 200;
                $returnStatus["success"] = true;
                $returnStatus["description"] = "Yorum gönderildi. :)";
    
            } else {
                $returnStatus["status"] = 200;
                $returnStatus["success"] = false;
                $returnStatus["description"] = "Yorum gönderilemedi. Lütfen tekrar deneyiniz :(";
            } 
        }
        else {
                $returnStatus["status"] = 404;
                $returnStatus["success"] = false;
                $returnStatus["description"] = "Paylaşım veya hesap bulunamadı";
        }

        

        
        return json_encode((array) $returnStatus);
    }

}
