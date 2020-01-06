<?php

require '../views/teams_view.php';

class teamsController {
    public function View(){
        return new teamsView;
    }
}