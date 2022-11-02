<?php
require_once './app/controllers/ApiController.php';
require_once './app/models/gender.model.php';

class GenderApiController extends ApiController {

  public function __construct() {
    parent::__construct();
    $this->model = new GenderModel();
  }

  public function getGenders(){
    $genders = $this->model->getAll();
    $this->view->response($genders,200);
  }

  public function getGender($params = null){
    $id = $params[':ID'];
    $gender = $this->model->get($id);
    if ($gender){
      $this->view->response($gender,200);
    }else {
      $this->view->response("El genero no existe",404);
    }
  }

  public function insertGender($params = null){
    $gender = $this->getData();
    if (empty($gender->name)){
      $this->view->response("Todos los campos deben estar completos",400);
    }else {
      $newGender = $this->model->insert($gender->name);
      $this->view->response($newGender,201);
    }
  }

  public function editGender($params = null){
    $id = $params[':ID'];
    $gender = $this->model->get($id);

    if ($gender){
      $newGender = $this->getData();
      $idEdited = $this->model->update($newGender->name,$id);
      $this->view->response("El genero con id: $idEdited se actualizo correctamente",200);
    }else {
      $this->view->response("El genero no existe",404);
    }
  }

  public function delete($params = null){
    $id = $params[':ID'];
    $gender = $this->model->get($id);
    if ($gender){
      if ($this->model->delete($id)){
        $this->view->response("El genero con id: $id se elimino correctamente",200);
      }else {
        $this->view->response("El genero no se pudo eliminar porque tiene datos relacionados aun",400);
      }
    }else {
      $this->view->response("El genero no se pudo eliminar",404);
    }
  }
}