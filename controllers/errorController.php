<?php

require_once '../views/error_404_view.php';

class ErrorController {
    public function _404(){
        return new Error404View();
    }
}