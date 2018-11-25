<?php 

class Pages extends Controller {
    
    public function __construct() {
        // Load the Model here
        // $this->postModel = $this->model('__YOUR_MODEL_NAME__');
    }

    public function index() {
        $data = [
            'title' => 'Blog Posts',
            'description' => 'Simple Social Blog site built on ViD-MVC Php framework.'
        ];
        $this->view('pages/index', $data);
    }

    public function about() {
        $data = [
            'title' => 'About',
            'description' => 'An app to share blog posts with other users.'

        ];
        $this->view('pages/about', $data);
    }
}