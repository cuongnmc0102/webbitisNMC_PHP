<?php

class SaleController extends Controller
{
    protected $saleModel;
    protected $productModel;
    
    public function __construct()
    {
        $this->saleModel = $this->loadModel('SaleModel');
        $this->productModel = $this->loadModel('ProductModel');
    }

    public function view()
    {
        $sale = $this->saleModel->show();
        if ($sale) {
            $data['title'] = 'Săn ưu đãi - Bitis NMC';
            $data['sales'] =  $sale;

            #Xử lý Phân Trang
            $limit = 9;
            $page = 1;

            if (isset($_GET['page']) && $_GET['page'] > 1) {
                $page = intval($_GET['page']);
            }
            $offset = ($page - 1 ) * $limit;

            #Tính tổng số Row
            $numRows = $this->productModel->num($id);
            $sumPage = ceil($numRows / $limit);
            #End Phân trang
            
            $data['page'] = page($sumPage, '/san-uu-dai/' . '/' . Helper::slug($sale['title']) .'');
            $data['products'] = $this->productModel->getAll($id, $limit, $offset);
            
            $data['template'] = 'sale';
           
            
            return $this->loadView('main', $data);
        }

        return Helper::redirect();
    }

}