<?php

class ProductSliderController extends Auth
{
    protected $producSliderModel;
    public function __construct()
    {
        parent::__construct();
        $this->productSliderModel = $this->loadModel('Admin/ProductSliderModel');
    }

    public function add()
    {
        $data['title'] = 'Thêm Product Slider Mới';
        $data['template'] = 'product-slider/add';
        $data['products'] = $this->productSliderModel->getProduct();

        return $this->loadView('admin/main', $data);
    }

    public function store()
    {
        if (isset($_POST['add'])) {

            #Lấy toàn bộ thông tin form
            
            $product = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
            
            $active = isset($_POST['active']) ? intval($_POST['active']) : 0;

            if (!isset($_FILES['file']['name']) || $_FILES['file']['name'] == '') {
                Helper::flash('errors', 'Vui lòng chọn 1 tấm ảnh ');
                return Helper::redirect('admin/productslider/add');
            }

    
            #Kiểm tra định dạng Ảnh
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if (!$check) {
                Helper::flash('errors', 'File upload không đúng định dạng');
                return Helper::redirect('admin/productslider/add');
            }

            // Check file size
            if ($_FILES["file"]["size"] > 5000000) {
                Helper::flash('errors', 'File upload tối đa 5M');
                return Helper::redirect('admin/productslider/add');
            }

            $pathImg = getPathFolder('product-slider') . basename($_FILES["file"]["name"]);
            move_uploaded_file($_FILES['file']['tmp_name'], $pathImg);


            $dataInsert = [
                'url' => '/'. $pathImg,
                'product_id' => $product,
                'active' => $active
            ];

            $result = $this->productSliderModel->insert($dataInsert);
            if ($result) {
                Helper::flash('success', 'Thêm Sản Phẩm Mới Thành Công');
                return Helper::redirect('admin/productslider/add');
            }

            Helper::flash('errors', 'Thêm Sản Phẩm Mới Lỗi');
            return Helper::redirect('admin/productslider/add');
        }

        return Helper::redirect('admin/productslider/add');
    }


    public function lists()
    {
        $data['title'] = 'Danh Sách Product Slider';
    

        #Xử lý Phân Trang
        $limit = 15;
        $page = 1;

        if (isset($_GET['page']) && $_GET['page'] > 1) {
            $page = intval($_GET['page']);
        }
        $offset = ($page - 1 ) * $limit;

        #Tính tổng số Row
        $numRows = $this->productSliderModel->num();
        $sumPage = ceil($numRows / $limit);

        #End Phân trang

        $data['products'] = $this->productSliderModel->get($limit, $offset);
        $data['template'] = 'product-slider/list';
        $data['page'] = page($sumPage, '/admin/productslider/lists');

         
        return $this->loadView('admin/main', $data);
    }

    public function edit($id = 0)
    {
        $productslider = $this->productSliderModel->show($id);
        if ($productslider) {

            $data['title'] = 'Chỉnh Sửa Product Slider: ' . $productslider['id'];
            $data['productslider'] = $productslider;
            $data['template'] = 'product-slider/edit';
            $data['products'] = $this->productSliderModel->getProduct();

            return $this->loadView('admin/main', $data);
        }

        Helper::flash('errors', 'ID Không tồn tại');
        return Helper::redirect('admin/productslider/lists');
    }


    public function update($id = 0)
    {
        if (isset($_POST['update'])) {

            #Kiểm tra tồn tại ID
            $productslider = $this->productSliderModel->show($id);
            if ($productslider) {

                #Lấy toàn bộ thông tin form
                $product = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
            
                $active = isset($_POST['active']) ? intval($_POST['active']) : 0;


                $dataUpdate = [
                    
                    'product_id' => $product,
                    'active' => $active,
                ];


                #Kiểm tra Người dùng có chọn ảnh hay không
                if ($_FILES['file']['name'] != '') {
                    
                    #Kiểm tra định dạng Ảnh
                    $check = getimagesize($_FILES["file"]["tmp_name"]);
                    if (!$check) {
                        Helper::flash('errors', 'File upload không đúng định dạng');
                        return Helper::redirect('admin/productslider/edit/' . $id);
                    }

                    // Check file size
                    if ($_FILES["file"]["size"] > 5000000) {
                        Helper::flash('errors', 'File upload tối đa 5M');
                        return Helper::redirect('admin/productslider/edit/' . $id);
                    }

                    $pathImg = getPathFolder('product-slider') . basename($_FILES["file"]["name"]);
                    move_uploaded_file($_FILES['file']['tmp_name'], $pathImg);
                    
                    $dataUpdate['url'] = '/'. $pathImg;
                }


                $result = $this->productSliderModel->update($dataUpdate, $id);
                if ($result) {
                    Helper::flash('success', 'Cập nhật Thành Công');
                    return Helper::redirect('admin/productslider/edit/' . $id);
                }

                Helper::flash('errors', 'Cập nhật  Lỗi');
                return Helper::redirect('admin/productslider/edit/' . $id);
            }

            Helper::flash('errors', 'ID Không tồn tại');
            return Helper::redirect('admin/productslider/lists');
        }

        return Helper::redirect('admin/productslider/lists');
    }

    public function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

            $productslider = $this->productSliderModel->show($id);
            if ($productslider) {

                unlink("./". $productslider['url']);

                $delete = $this->productSliderModel->remove($id);
                if ($delete) {
                    return Helper::json([
                        'error' => false,
                        'message' => 'Xóa thành công'
                    ]);
                }
            }
        }

        return Helper::json([
            'error' => true,
            'message' => 'Xóa Lỗi'
        ]);
    }
}