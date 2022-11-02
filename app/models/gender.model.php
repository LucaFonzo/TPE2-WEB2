<?php

class GenderModel {
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
    $query = $this->db->prepare("SELECT * FROM genders");
    $query->execute();
    $genders = $query->fetchAll(PDO::FETCH_OBJ);
    return $genders;
  } catch (PDOException $error) {
    return false;
  }
  }

  public function get($id){
    $query = $this->db->prepare("SELECT * FROM genders WHERE id_gender = ?");
    $query->execute([$id]);
    $gender = $query->fetchAll(PDO::FETCH_OBJ);
    return $gender;
  }

  public function insert($gender){
    try {
      $query = $this->db->prepare('INSERT INTO `genders` (`id_gender`, `name`) VALUES (?, ?)');
      $query->execute([null,$gender]);
      return $this->db->lastInsertId();
    } catch (PDOException $error) {
      return false;
    }
  }

  public function update($gender,$id){
    try {
      $query = $this->db->prepare('UPDATE `genders` SET `name` = ? WHERE `genders`.`id_gender` = ?');
      $query->execute([$gender,$id]);
      return $id;
    } catch (\Throwable $th) {
      //throw $th;
    }
    
  }

  public function delete($id){
    try {
      $query = $this->db->prepare("DELETE FROM genders WHERE `genders`.`id_gender` = ?");
      $query->execute([$id]);
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }
}