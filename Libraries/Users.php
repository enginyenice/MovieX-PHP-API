<?php
require_once 'Database.php';
class Users
{
    private $conn;
    function __construct()
    {
        $conn = new Database();
        $this->conn = $conn->connect();
    }
    public function getUserCount($userName, $password)
    {
        $statement = $this->conn->prepare("SELECT count(*) as userCount FROM users WHERE username=:username and password=:password");
        $statement->execute(array(
            "username" => $userName,
            "password"  => $password
        ));
        $results = $statement->fetchAll(PDO::FETCH_CLASS);
        $count = $results[0]->userCount;
        $response = array();
        if ($count > 0) {
            $response = array(
                "login"    => true,
                "userId"   => $this->getUserId($userName, $password)
            );
        } else {
            $response = array(
                "login"    => false
            );
        }
        return json_encode((array) $response);
    }
    public function getUserId($userName, $password)
    {
        $statement = $this->conn->prepare("SELECT id FROM users WHERE username=:username and password=:password");
        $statement->execute(array(
            "username" => $userName,
            "password"  => $password
        ));
        $results = $statement->fetchAll(PDO::FETCH_CLASS);
        $id = $results[0]->id;
        return $id;
    }

    public function SetUser($username, $password)
    {
        $response = array();
        if ($this->getUserNameCount($username) == 0) {
            $sql = "INSERT INTO users (username,password) VALUES (:username,:password)";
            $query = $this->conn->prepare($sql);
            $status = $query->execute(array(
                "username"        => $username,
                "password"        => $password
            ));

            if ($status) {
                $response = array(
                    "status"    => "success",
                    "userId"    => $this->getUserId($username, $password)
                );
            } else {
                $response = array(
                    "status"        => "error",
                    "description"   => "Kayıt edilirken bir hata oluştur"
                );
            }
        } else {
            $response = array(
                "status"        => "error",
                "description"   => "Böyle bir kullanıcı var"
            );
        }
        return json_encode((array) $response);
    }
    public function getUserNameCount($userName)
    {
        $statement = $this->conn->prepare("SELECT count(*) as userCount FROM users WHERE username=:username");
        $statement->execute(array(
            "username" => $userName
        ));
        $results = $statement->fetchAll(PDO::FETCH_CLASS);
        $count = $results[0]->userCount;
        return $count;
    }
    public function EditUser($userId,$password)
    {
        if($this->getUserIdCount($userId) > 0) {
        $sql = "UPDATE users
        SET password=:password
        WHERE id=:id;";
        $query = $this->conn->prepare($sql);
        $status = $query->execute(array(
            "id"              => $userId,
            "password"        => $password
        ));
        $response = array();
        if ($status) {
            $response = array(
                "status"    => "success"
            );
        } else {
            $response = array(
                "status"        => "error",
                "code"          => 0,
                "description"   => "Şifre değiştirilirken bir hata oluştu."
            );
        }
    } else {
        $response = array(
            "status"        => "error",
            "code"          => 1,
            "description"   => "Geçersiz kullanıcı"
        );
    }
        return json_encode((array) $response);
    }
    public function getUsername($userId)
    {

        $response = array();
        if ($this->getUserIdCount($userId) > 0) {
            $statement = $this->conn->prepare("SELECT username FROM users WHERE id=:id");
            $statement->execute(array(
                "id" => $userId,
            ));
            $results = $statement->fetchAll(PDO::FETCH_CLASS);

            $username = $results[0]->username;
            $response = array(
                "status"    => 200,
                "username"   => $username
            );
        } else {
            $response = array(
                "status"    => 404,
                "username"   => "Not found"
            );
        }
        return json_encode((array) $response);
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
