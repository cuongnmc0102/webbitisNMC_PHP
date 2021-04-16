<?php

class ProductController extends Controller
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = $this->loadModel('ProductModel');    
    }

    public function view($id = 0)
    {
        $product = $this->productModel->show($id);
        if ($product) {
            $data['title'] = Helper::decodeSafe($product['title']);
            $data['template'] = 'product/content';
            $data['product'] = $product;
            $data['sliders'] = $this->productModel->getSlider($id);
            $data['productMores'] = $this->productModel->more($product);

            return $this->loadView('main', $data);
        }

        return Helper::redirect();
    }
}