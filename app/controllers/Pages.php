<?php 

class Pages extends Controller {
    
    public function __construct() {
        // Load the Model here
        // $this->postModel = $this->model('__YOUR_MODEL_NAME__');
    }

    public function index() {
        $data = [
            'title' => 'Blog Posts',
        ];
        $this->view('pages/index', $data);
    }

    public function test() {
        $data = [
            'title' => 'Test'
        ];
        $this->view('pages/test', $data);
    }
}