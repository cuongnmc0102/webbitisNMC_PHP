<?php

class ProductController extends Auth
{
    protected $productModel;
    public function __construct()
    {
        parent::__construct();
        $this->productModel = $this->loadModel('Admin/ProductModel');
    }

    public function add()
    {
        $data['title'] = 'Thêm Sản Phẩm Mới';
        $data['template'] = 'product/add';
        $data['menus'] = $this->productModel->getMenu();

        return $this->loadView('admin/main', $data);
    }

    public function store()
    {
        if (isset($_POST['add'])) {

            #Lấy toàn bộ thông tin form
            $title = isset($_POST['title']) ? Helper::makeSafe($_POST['title']) : '';
            $menu = isset($_POST['menu_id']) ? intval($_POST['menu_id']) : 0;
            $price = isset($_POST['price']) ? intval($_POST['price']) : 0;
            $sale_price = isset($_POST['sale_price']) ? intval($_POST['sale_price']) : 0;
            $description = isset($_POST['description']) ? Helper::makeSafe($_POST['description']) : '';
            $content = isset($_POST['content']) ? Helper::makeSafe($_POST['content']) : '';
            $active = isset($_POST['active']) ? intval($_POST['active']) : 0;


            if ($title == '') {
                Helper::flash('errors', 'vui lòng nhập Tên sản phẩm');
                return Helper::redirect('admin/product/add');
            }

            if (!isset($_FILES['file']['name']) || $_FILES['file']['name'] == '') {
                Helper::flash('errors', 'Vui lòng chọn 1 tấm ảnh ');
                return Helper::redirect('admin/product/add');
            }

            #Kiểm tra giá tiền
            if ($price > 0 && $sale_price > 0) {
                if ($sale_price >= $price) {
                    Helper::flash('errors', 'Giá giảm không được lớn hơn hoặc bằng giá gốc');
                    return Helper::redirect('admin/product/add');
                }
            }

            #Kiểm tra định dạng Ảnh
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if (!$check) {
                Helper::flash('errors', 'File upload không đúng định dạng');
                return Helper::redirect('admin/product/add');
            }

            // Check file size
            if ($_FILES["file"]["size"] > 5000000) {
                Helper::flash('errors', 'File upload tối đa 5M');
                return Helper::redirect('admin/product/add');
            }

            $pathImg = getPathFolder('product') . basename($_FILES["file"]["name"]);
            move_uploaded_file($_FILES['file']['tmp_name'], $pathImg);


            $dataInsert = [
                'title' => $title,
                'menu_id' => $menu,
                'price' => $price,
                'sale_price' => $sale_price,
                'description' => $description,
                'content' => $content,
                'active' => $active,
                'thumb' => '/'. $pathImg,
                'created_at' => time()
            ];

            $result = $this->productModel->insert($dataInsert);
            if ($result) {
                Helper::flash('success', 'Thêm Sản Phẩm Mới Thành Công');
                return Helper::redirect('admin/product/add');
            }

            Helper::flash('errors', 'Thêm Sản Phẩm Mới Lỗi');
            return Helper::redirect('admin/product/add');
        }

        return Helper::redirect('admin/product/add');
    }


    public function lists()
    {
        $data['title'] = 'Danh Sách Sản Phẩm';
    

        #Xử lý Phân Trang
        $limit = 15;
        $page = 1;

        if (isset($_GET['page']) && $_GET['page'] > 1) {
            $page = intval($_GET['page']);
        }
        $offset = ($page - 1 ) * $limit;

        #Tính tổng số Row
        $numRows = $this->productModel->num();
        $sumPage = ceil($numRows / $limit);

        #End Phân trang

        $data['products'] = $this->productModel->get($limit, $offset);
        $data['template'] = 'product/list';
        $data['page'] = page($sumPage, '/admin/product/lists');

         
        return $this->loadView('admin/main', $data);
    }

    public function edit($id = 0)
    {
        $product = $this->productModel->show($id);
        if ($product) {

            $data['title'] = 'Chỉnh Sửa Sản Phẩm: ' . $product['title'];
            $data['product'] = $product;
            $data['template'] = 'product/edit';
            $data['menus'] = $this->productModel->getMenu();

            return $this->loadView('admin/main', $data);
        }

        Helper::flash('errors', 'ID Không tồn tại');
        return Helper::redirect('admin/product/lists');
    }


    public function update($id = 0)
    {
        if (isset($_POST['update'])) {

            #Kiểm tra tồn tại ID
            $product = $this->productModel->show($id);
            if ($product) {

                #Lấy toàn bộ thông tin form
                $title = isset($_POST['title']) ? Helper::makeSafe($_POST['title']) : '';
                $menu = isset($_POST['menu_id']) ? intval($_POST['menu_id']) : 0;
                $price = isset($_POST['price']) ? intval($_POST['price']) : 0;
                $sale_price = isset($_POST['sale_price']) ? intval($_POST['sale_price']) : 0;
                $description = isset($_POST['description']) ? Helper::makeSafe($_POST['description']) : '';
                $content = isset($_POST['content']) ? Helper::makeSafe($_POST['content']) : '';
                $active = isset($_POST['active']) ? intval($_POST['active']) : 0;


                if ($title == '') {
                    Helper::flash('errors', 'Vui lòng nhập Tên sản phẩm');
                    return Helper::redirect('admin/product/add');
                }


                #Kiểm tra giá tiền
                if ($price > 0 && $sale_price > 0) {
                    if ($sale_price >= $price) {
                        Helper::flash('errors', 'Giá giảm không được lớn hơn hoặc bằng giá gốc');
                        return Helper::redirect('admin/product/add');
                    }
                }

                $dataUpdate = [
                    'title' => $title,
                    'menu_id' => $menu,
                    'price' => $price,
                    'sale_price' => $sale_price,
                    'description' => $description,
                    'content' => $content,
                    'active' => $active,
                ];


                #Kiểm tra Người dùng có chọn ảnh hay không
                if ($_FILES['file']['name'] != '') {
                    
                    #Kiểm tra định dạng Ảnh
                    $check = getimagesize($_FILES["file"]["tmp_name"]);
                    if (!$check) {
                        Helper::flash('errors', 'File upload không đúng định dạng');
                        return Helper::redirect('admin/product/edit/' . $id);
                    }

                    // Check file size
                    if ($_FILES["file"]["size"] > 5000000) {
                        Helper::flash('errors', 'File upload tối đa 5M');
                        return Helper::redirect('admin/product/edit/' . $id);
                    }

                    $pathImg = getPathFolder('product') . basename($_FILES["file"]["name"]);
                    move_uploaded_file($_FILES['file']['tmp_name'], $pathImg);
                    
                    $dataUpdate['thumb'] = '/'. $pathImg;
                }


                $result = $this->productModel->update($dataUpdate, $id);
                if ($result) {
                    Helper::flash('success', 'Cập nhật Thành Công');
                    return Helper::redirect('admin/product/edit/' . $id);
                }

                Helper::flash('errors', 'Cập nhật  Lỗi');
                return Helper::redirect('admin/product/edit/' . $id);
            }

            Helper::flash('errors', 'ID Không tồn tại');
            return Helper::redirect('admin/product/lists');
        }

        return Helper::redirect('admin/product/lists');
    }

    public function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

            $product = $this->productModel->show($id);
            if ($product) {

                unlink("./". $product['thumb']);

                $delete = $this->productModel->remove($id);
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