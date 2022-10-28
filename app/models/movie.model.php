<?php
class MovieModel{
  private $db;

  public function __construct(){
    $this->db = $this->connectDB();
  }

  private function connectDB(){
      $db = new PDO('mysql:host=localhost;'.'dbname=db_movies;charset=utf8', 'root', '');
      return $db;
  }

  public function getAll(){
    $query = $this->db->prepare("SELECT movies.*, genders.* FROM movies JOIN genders ON movies.id_gender_fk = genders.id_gender");
    $query->execute();
    $movies = $query->fetchAll(PDO::FETCH_OBJ);
    return $movies;
  }

  public function getMoviesByGender($id){
    $query = $this->db->prepare("SELECT movies.*, genders.* FROM movies JOIN genders ON movies.id_gender_fk = genders.id_gender WHERE movies.id_gender_fk = ?");
    $query->execute([$id]);
    $movies = $query->fetchAll(PDO::FETCH_OBJ);
    return $movies;
  }

  public function get($id){
    $query = $this->db->prepare("SELECT movies.*, genders.name FROM movies JOIN genders ON movies.id_gender_fk = genders.id_gender WHERE movies.id_movie = ?");
    $query->execute([$id]);
    $movie = $query->fetch(PDO::FETCH_OBJ);
    return $movie;
  }

  public function insert($titulo,$descripcion,$autor,$fechaEstreno,$idGenero,$imagen = null){
    $pathImagen = '';
    if ($imagen){
      $pathImagen = $this->uploadImage($imagen);
    }
    $query = $this->db->prepare("INSERT INTO `movies` (`title`, `description`, `author`, `premiere_date`, `id_gender_fk`, `image`) VALUES (?,?,?,?,?,?)");
    $query->execute([$titulo,$descripcion,$autor,$fechaEstreno,$idGenero,$pathImagen]);
    return $this->db->lastInsertId();
  }

  public function update($titulo,$descripcion,$autor,$fechaEstreno,$idGenero,$id,$imagen = null){
    $pathImagen = '';
    if ($imagen){
      $pathImagen = $this->uploadImage($imagen);
    }
    $query = $this->db->prepare("UPDATE `movies` SET `title` = ?, `description` = ?, `author` = ?, `premiere_date` = ?, `image` = ?, `id_gender_fk` = ? WHERE `movies`.`id_movie` = ?");
    $query->execute([$titulo,$descripcion,$autor,$fechaEstreno,$pathImagen,$idGenero,$id]);
    return $id;
  }

  public function delete($id){
    $query = $this->db->prepare("DELETE FROM movies WHERE `movies`.`id_movie` = ?");
    $query->execute([$id]);
  }

  private function uploadImage($image){
        $target = "img/movie/" . uniqid() . "." . strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        move_uploaded_file($image['tmp_name'], $target);
        return $target;
    }
}
