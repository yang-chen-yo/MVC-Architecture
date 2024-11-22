<?php

class PostController extends Controller
{
    private $postModel;

    public function __construct() {
      
    }

    public function show() {
        
        $data = [
            'id' => 1,
            'title' => "1234",
            'body' => "741852"
        ];
        $this->view('show', $data);
    }

}
