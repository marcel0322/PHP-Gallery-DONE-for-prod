<?php

require '../views/signup_view.php';

class signupController {
    public function View(){
        return new signupView;
    }
}