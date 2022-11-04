<?php
require_once './app/views/api.view.php';
require_once './app/helpers/auth-api.helper.php';
abstract class ApiController {
    protected $model;
    protected $view;
    private $data;
    private $autHelper;

    public function __construct() {
        $this->view = new ApiView();
        $this->authHelper = new AuthApiHelper();
        $this->data = file_get_contents("php://input");
    }

    public function getData(){
        return json_decode($this->data);
    }
}