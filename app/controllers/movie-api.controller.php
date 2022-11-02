<?php
require_once './app/controllers/ApiController.php';
require_once './app/models/movie.model.php';

class MovieApiController extends ApiController {

  public function __construct() {
    parent::__construct();
    $this->model = new MovieModel();
  }

  public function getMovies($params = null){
    $movies = $this->model->getAll();
    $this->view->response($movies);
  }

  public function getMovie($params = null){
    $id = $params[':ID'];
    $movie = $this->model->get($id);

    if ($movie){
      $this->view->response($movie);
    }else {
      $this->view->response("La pelicula no existe",404);
    }
  }

  public function deleteMovie($params = null){
    $id = $params[':ID'];

    $movie = $this->model->get($id);
    if ($movie){
      $this->model->delete($id);
      $this->view->response($movie);
    }else {
      $this->view->response("La pelicula no existe",404);
    }
  }
  public function insertMovie($params = null){
    $movie = $this->getData();
    if (empty($movie->title) || empty($movie->description) || empty($movie->author) || empty($movie->premiere_date) || empty($movie->id_gender_fk)){
      $this->view->response("Todos los campos deben estar completos",400);
    }else {
      $id = $this->model->insert($movie->title,$movie->description,$movie->author,$movie->premiere_date,$movie->id_gender_fk,$movie->image);
      $movie = $this->model->get($id);
      $this->view->response($movie,201);
    }
  }

  public function editMovie($params = null){
    $id = $params[':ID'];
    $movieToEdit = $this->model->get($id);
    if ($movieToEdit){
      $movie = $this->getData();
      if (empty($movie->title) || empty($movie->description) || empty($movie->author) || empty($movie->premiere_date) || empty($movie->id_gender_fk)){
      $this->view->response("Todos los campos deben estar completos",400);
      }else {
        $movieEdited = $this->model->update($movie->title,$movie->description,$movie->author,$movie->premiere_date,$movie->id_gender_fk,$id,$movie->image);
        $this->view->response("Pelicula con id: $id actualizada con exito",200);
      }
    }else {
      $this->view->response("La pelicula a editar no existe",404);
    }
  }
}