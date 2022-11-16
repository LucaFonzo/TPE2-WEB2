<?php
require_once './app/controllers/ApiController.php';
require_once './app/models/review.model.php';

class ReviewApiController extends ApiController{
  public function __construct() {
    parent::__construct();
    $this->model = new ReviewModel();
  }

  public function getAll($params = null){
    if (isset($_GET['sort']) && isset($_GET['order']))
    {
      $sorters = array("id_review","review","id_movie_fk");
      $orders = array("asc","desc");
      if (!in_array($_GET['sort'],$sorters) || !in_array($_GET['order'],$orders)){
        $this->view->response("Ese orden no existe",400); //400 o 404?
      }else
      {
      $sort = $_GET['sort'];
      $order = $_GET['order'];
      $reviews = $this->model->getAllByOrder($sort,$order);
        if ($reviews)
        {
          $this->view->response($reviews);
        }
        else
        {
          $this->view->response("No se encontraron reviews",404); //400 o 404?
        }
      }
    }else if (isset($_GET['page']) && isset($_GET['limit']))
    {
      $page = $_GET['page'];
      $limit = $_GET['limit'];
      $page = (int)$page;
      $limit = (int)$limit;
      $offSet = ($limit * $page) - $limit;
      $reviews = $this->model->getByPagination($offSet,$limit);
      if ($reviews)
      {
        $this->view->response($reviews);
      }else
      {
        $this->view->response("No se encontraron reviews",404);
      }
    }else if (isset($_GET['filter']) && isset($_GET['value'])){
      $filters = array("id_movie_fk");
      if (in_array($_GET['filter'],$filters)){
        $filter = $_GET['filter'];
        $value = $_GET['value'];
        $reviews = $this->model->getByFiltering($filter,$value);
        if ($reviews){
          $this->view->response($reviews);
        }else {
          $this->view->response("No se encontraron reviews",404);
        }
      }
    }
    else
    {
      $reviews = $this->model->getAll();
      if ($reviews){
        $this->view->response($reviews);
      }else {
        $this->view->response("No se encontraron reviews",404);
      }
    }
  }

  public function get($params = null){
    $id = $params[':ID'];
    $review = $this->model->get($id);

    if ($review){
      $this->view->response($review);
    }else {
      $this->view->response("La review no existe",404);
    }
  }

  public function delete($params = null){
    $id = $params[':ID'];

    $review = $this->model->get($id);
    if ($review){
      $this->model->delete($id);
      $this->view->response($review);
    }else {
      $this->view->response("La review no existe",404);
    }
  }

  public function insert($params = null){
    $review = $this->getData();
    if(!$this->authHelper->isLoggedIn()){
      $this->view->response("No estas logeado", 401);
      return;
    }

    if (empty($review->review) || empty($review->id_movie_fk) ){
      $this->view->response("Todos los campos deben estar completos",400);
    }else {
      $id = $this->model->insert($review->review,$review->id_movie_fk);
      if ($id){
        $review = $this->model->get($id);
      $this->view->response($review,201);
      }else {
        $this->view->response("Uno de los campos no es valido",400);
      }
    }
  }

  public function edit($params = null){
    $id = $params[':ID'];
    $reviewToEdit = $this->model->get($id);
    if(!$this->authHelper->isLoggedIn()){
      $this->view->response("No estas logeado", 401);
      return;
    }
    if ($reviewToEdit){
      $review = $this->getData();
      if (empty($review->review) || empty($review->id_movie_fk)){
      $this->view->response("Todos los campos deben estar completos",400);
      }else {
        $reviewEdited = $this->model->update($review->review,$review->id_movie_fk,$id);
        $this->view->response("La review con id: $id fue actualizada con exito",200);
      }
    }else {
      $this->view->response("La review a editar no existe",404);
    }
  }
}
