<?php
namespace application\controllers;

class TodoController extends Controller {
  public function main() {
    return "index.html";
  }
  
  public function index() {
    switch(getMethod()) {
      case _GET:
        return $this->model->selTodoList();
        /*
        $todo = $_GET["itodo"];
        $param = [
          "itodo" => $todo
        ];
        return $this->model->selTodoList($param);
        */

      case _POST:
        $json = getJson();
        return [_RESULT => $this->model->insTodo($json)];
        /*
        $todo = $_POST["todo"];
        $param = [
          "todo" => $todo
        ];
        return $this->model->insTodo($param);
        */
      case _DELETE:
        $urlPaths = getUrlPaths();
        $param = [
          "itodo" => 0  // 디폴트 값은 0
        ];

        if(isset($urlPaths[2])) { // itodo값이 0 이면 전체 삭제, 0 이 아니면 부분 삭제
          $param["itodo"] = intval($urlPaths[2]); 
        }

        return [_RESULT => $this->model->delTodo($param)];
        /*
        $json = getJson();
        $param["itodo"] = $json["itodo"];
        return $this->model->delTodo($param);
        */
    }
  }
}