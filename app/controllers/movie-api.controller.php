<?php
require_once './app/controllers/ApiController.php';
require_once './app/models/movie.model.php';


class MovieApiController extends ApiController {

  public function __construct() {
    parent::__construct();
    $this->model = new MovieModel();
  }

  public function getAll($params = null){
    if (isset($_GET['sort']) && isset($_GET['order']))
    {
      $sorters = array("id_movie","title","description","author","premiere_date","id_gender_fk","image");
      $orders = array("asc","desc");
      if (!in_array($_GET['sort'],$sorters) || !in_array($_GET['order'],$orders)){
        $this->view->response("Ese orden no existe",400);
      }else
      {
      $sort = $_GET['sort'];
      $order = $_GET['order'];
      $movies = $this->model->getAllByOrder($sort,$order);
        if ($movies)
        {
          $this->view->response($movies);
        }
        else
        {
          $this->view->response("No se encontraron peliculas",404);
        }
      }
    }else if (isset($_GET['page']) && isset($_GET['limit']))
    {
      $page = $_GET['page'];
      $limit = $_GET['limit'];
      $page = (int)$page;
      $limit = (int)$limit;
      $offSet = ($limit * $page) - $limit;
      $movies = $this->model->getByPagination($offSet,$limit);
      if ($movies)
      {
        $this->view->response($movies);
      }else
      {
        $this->view->response("No se encontraron peliculas",404);
      }
    }else if (isset($_GET['filter']) && isset($_GET['value'])){
      $filters = array("id_gender_fk");
      if (in_array($_GET['filter'],$filters)){
        $filter = $_GET['filter'];
        $value = $_GET['value'];
        $movies = $this->model->getByFiltering($filter,$value);
        if ($movies){
          $this->view->response($movies);
        }else{
          $this->view->response("No se encontraron peliculas",404);
        }
      }else {
        $this->view->response("Campo a filtrar no valido",400);
      }
    }
    else
    {
      $movies = $this->model->getAll();
      if ($movies){
        $this->view->response($movies);
      }else {
        $this->view->response("No se encontraron peliculas",404);
      }
    }
  }

  public function get($params = null){
    $id = $params[':ID'];
    $movie = $this->model->get($id);

    if ($movie){
      $this->view->response($movie);
    }else {
      $this->view->response("La pelicula no existe",404);
    }
  }

  public function delete($params = null){
    $id = $params[':ID'];

    $movie = $this->model->get($id);
    if ($movie){
      $this->model->delete($id);
      $this->view->response("La pelicula con id: $id se borro con exito");
    }else {
      $this->view->response("La pelicula no existe",404);
    }
  }

  public function insert($params = null){
    $movie = $this->getData();
    if(!$this->authHelper->isLoggedIn()){
      $this->view->response("No estas logeado", 401);
      return;
    }
    if (empty($movie->title) || empty($movie->description) || empty($movie->author) || empty($movie->premiere_date) || empty($movie->id_gender_fk)){
      $this->view->response("Todos los campos deben estar completos",400);
    }else {
      $id = $this->model->insert($movie->title,$movie->description,$movie->author,$movie->premiere_date,$movie->id_gender_fk,$movie->image);
      if ($id){
        $movie = $this->model->get($id);
        $this->view->response($movie,201);
      }else {
        $this->view->response("Uno de los campos no es valido",400);
      }
    }
  }

  public function edit($params = null){
    $id = $params[':ID'];
    $movieToEdit = $this->model->get($id);
    if(!$this->authHelper->isLoggedIn()){
      $this->view->response("No estas logeado", 401);
      return;
    }
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