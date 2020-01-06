<?php

require '../views/gallery_view.php';

class galleryController {
    public function View(){
        return new galleryView;
    }
}