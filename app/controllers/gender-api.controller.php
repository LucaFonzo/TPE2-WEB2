<?php
require_once './app/controllers/ApiController.php';
require_once './app/models/gender.model.php';

class GenderApiController extends ApiController {

  public function __construct() {
    parent::__construct();
    $this->model = new GenderModel();
  }

  public function getAll(){
    if (isset($_GET['sort']) && isset($_GET['order']))
    {
      $sorters = array("id_gender","name");
      $orders = array("asc","desc");
      if (!in_array($_GET['sort'],$sorters) || !in_array($_GET['order'],$orders)){
        $this->view->response("Ese orden no existe",400);
      }else
      {
      $sort = $_GET['sort'];
      $order = $_GET['order'];
      $genders = $this->model->getAllByOrder($sort,$order);
        if ($genders)
        {
          $this->view->response($genders);
        }
        else
        {
          $this->view->response("No se encontraron generos",404);
        }
      }
    }else if (isset($_GET['page']) && isset($_GET['limit']))
    {
      $page = $_GET['page'];
      $limit = $_GET['limit'];
      $page = (int)$page;
      $limit = (int)$limit;
      $offSet = ($limit * $page) - $limit;
      $genders = $this->model->getByPagination($offSet,$limit);
      if ($genders)
      {
        $this->view->response($genders);
      }else
      {
        $this->view->response("No se encontraron generos",404);
      }
    }else if (isset($_GET['filter']) && isset($_GET['value'])){
      $filters = array("stars");
      if (in_array($_GET['filter'],$filters)){
        $filter = $_GET['filter'];
        $value = $_GET['value'];
        $genders = $this->model->getByFiltering($filter,$value);
        if ($genders){
          $this->view->response($genders);
        }else {
          $this->view->response("No se encontraron generos",404);
        }
      }else {
        $this->view->response("El campo a filtrar no existe",400);
      }
    }
    else
    {
      $genders = $this->model->getAll();
      if ($genders){
        $this->view->response($genders);
      }else {
        $this->view->response("No se encontraron generos",404);
      }
    }
  }

  public function get($params = null){
    $id = $params[':ID'];
    $gender = $this->model->get($id);
    if ($gender){
      $this->view->response($gender,200);
    }else {
      $this->view->response("El genero no existe",404);
    }
  }

  public function insert($params = null){
    $gender = $this->getData();
    if(!$this->authHelper->isLoggedIn()){
      $this->view->response("No estas logeado", 401);
      return;
    }
    if (empty($gender->name)){
      $this->view->response("Todos los campos deben estar completos",400);
    }else {
      $newGender = $this->model->insert($gender->name);
      $this->view->response($newGender,201);
    }
  }

  public function edit($params = null){
    $id = $params[':ID'];
    $gender = $this->model->get($id);
    if(!$this->authHelper->isLoggedIn()){
      $this->view->response("No estas logeado", 401);
      return;
    }
    if ($gender){
      $newGender = $this->getData();
      $idEdited = $this->model->update($newGender->name,$id);
      $this->view->response("El genero con id: $idEdited se actualizo correctamente",200);
    }else {
      $this->view->response("El genero a editar no existe",404);
    }
  }

  public function delete($params = null){
    $id = $params[':ID'];
    $gender = $this->model->get($id);
    if ($gender){
      $this->model->delete($id);
      $gender = $this->model->get($id);
      if ($gender){
        $this->view->response("El genero no se pudo eliminar porque tiene registros asociados",400);
      }else {
        $this->view->response("El genero con id: $id se elimino correctamente",200);
      }
    }else {
      $this->view->response("El genero a eliminar no existe",404);
    }
  }
}