<?php

class MainController extends Controller
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = $this->loadModel('ProductModel');
    }

    public function index()
    {
        $data['title'] = 'STORE BITIS NMC';
        $data['products'] = $this->productModel->get();
        $data['template'] = 'home';
        
        return $this->loadView('main', $data);
    }
}