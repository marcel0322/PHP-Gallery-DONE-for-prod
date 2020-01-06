<?php

require '../business/fileHandling.php';
require '../views/form_view.php';

class uploadController extends fileHandling{
    public function uploadFile() {
        $upload = new fileHandling();
        $upload -> upload();

        return new formView;
    }
}