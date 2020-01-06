<?php

require '../views/index_view.php';

class indexController {
    public function View(){
        return new indexView;
    }
}