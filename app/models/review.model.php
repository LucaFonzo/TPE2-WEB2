<?php

class ReviewModel{
  private $db;

  public function __construct(){
    $this->db = $this->connectDB();
  }

  private function connectDB(){
    try {
      $db = new PDO('mysql:host=localhost;'.'dbname=db_movies;charset=utf8', 'root', '');
      return $db;
    } catch (PDOException $error) {
      return false;
    }
  }

  public function getAll(){
    try {
    $query = $this->db->prepare("SELECT * FROM reviews");
    $query->execute();
    $reviews = $query->fetchAll(PDO::FETCH_OBJ);
    return $reviews;
  } catch (PDOException $error) {
    return false;
  }
  }

  public function getAllByOrder($sort,$order){
    try {
      $query = $this->db->prepare("SELECT * FROM reviews ORDER BY $sort $order");
      $query->execute();
      $reviews = $query->fetchAll(PDO::FETCH_OBJ);
      return $reviews;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function getByPagination($offSet,$limit){
    try {
      $query = $this->db->prepare("SELECT * FROM reviews LIMIT ? OFFSET ?");
      $query->bindParam(1, $limit, PDO::PARAM_INT);
      $query->bindParam(2, $offSet, PDO::PARAM_INT);
      $query->execute();
      $reviews = $query->fetchAll(PDO::FETCH_OBJ);
      return $reviews;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function getByFiltering($filter,$value){
    $query = $this->db->prepare("SELECT * FROM reviews WHERE $filter = $value");
    $query->execute();
    $reviews = $query->fetchAll(PDO::FETCH_OBJ);
    return $reviews;
  }

  public function get($id){
    $query = $this->db->prepare("SELECT * FROM reviews WHERE id_review = ?");
    $query->execute([$id]);
    $review = $query->fetchAll(PDO::FETCH_OBJ);
    return $review;
  }

  public function insert($review,$id_movie_fk){
    try {
      $query = $this->db->prepare('INSERT INTO reviews (`review`, `id_movie_fk`) VALUES (?,?)');
      $query->execute([$review,$id_movie_fk]);
      return $this->db->lastInsertId();
    } catch (\Throwable $th) {
      return false;
    }
      
  }

  public function update($review,$id_movie_fk,$id){
    try {
      $query = $this->db->prepare('UPDATE reviews SET `review` = ?, `id_movie_fk` = ? WHERE `reviews`.`id_review` = ?');
      $query->execute([$review,$id_movie_fk,$id]);
      return $id;
    } catch (\Throwable $th) {
      //throw $th;
    }
  }

  public function delete($id){
    try {
      $query = $this->db->prepare("DELETE FROM reviews WHERE `reviews`.`id_review` = ?");
      $query->execute([$id]);
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

}
