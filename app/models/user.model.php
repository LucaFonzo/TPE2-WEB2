<?php

class UserModel {
  private $db;

  public function __construct(){
    $this->db = $this->connectDB();
  }

  private function connectDB(){
      $db = new PDO('mysql:host=localhost;'.'dbname=db_movies;charset=utf8', 'root', '');
      return $db;
  }


  public function getUserByEmail($email) {
    $query = $this->db->prepare("SELECT * FROM users WHERE email = ?");
    $query->execute([$email]);
    return $query->fetch(PDO::FETCH_OBJ);
  }

  public function addUser($email,$password){
    $query = $this->db->prepare("INSERT INTO users (`email`,`password`) VALUES (?,?)");
    $query->execute([$email,$password]);
  }
}