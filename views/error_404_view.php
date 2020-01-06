<?php
class error404View {
    public function render(){
        http_response_code(404);
    }
}