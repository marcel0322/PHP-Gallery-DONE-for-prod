<?php

require_once '../business/fileHandling.php';

class file extends fileHandling{
    public $title;
    public $author;
    public $filename;
    protected $id;

    public function __construct($title, $author, $filename) {
        $this -> title = $title;
        $this -> author = $author;
        $this -> filename = $filename;
    }
}