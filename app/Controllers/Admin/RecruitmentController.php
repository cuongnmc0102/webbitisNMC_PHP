<?php

class RecruitmentController extends Auth
{
    protected $recruitmentModel;

    public function __construct()
    {
        parent::__construct();

        $this->recruitmentModel = $this->loadModel('Admin/RecruitmentModel');
    }

    public function add()
    {
        $data['title'] = 'Thêm Thông Tin Tuyển Dụng  Mới';
        $data['template'] = 'recruitment/add';

        return $this->loadView('admin/main', $data);
    }

    public function store()
    {
        if (isset($_POST['add'])) {
            $title = isset($_POST['title']) ? Helper::makeSafe($_POST['title']) : '';
            $content = isset($_POST['content']) ? Helper::makeSafe($_POST['content']) : '';
            $active = isset($_POST['active']) ? intval($_POST['active']) : 1;

            if ($title == '') {
                Helper::flash('errors', 'Vui lòng nhập tiêu đề tên vị trí tuyển dụng');
                return Helper::redirect('admin/recruitment/add');
            }


            $result = $this->recruitmentModel->insert($title, $content, $active);
            if ($result) {
                Helper::flash('success', 'Thêm Vị Trí Tuyển Dụng Thành Công');
                return Helper::redirect('admin/recruitment/add');
            }

            Helper::flash('errors', 'Thêm Vị Trí Tuyển Dụng Lỗi');
            return Helper::redirect('admin/recruitment/add');
        }


        return Helper::redirect('admin/recruitment/add');
    }

    public function lists()
    {
        $data['title'] = 'Danh Sách Vị Trí Tuyển Dụng';

        #Xử lý Phân Trang
        $limit = 10;
        $page = 1;

        if (isset($_GET['page']) && $_GET['page'] > 1) {
            $page = intval($_GET['page']);
        }
        $offset = ($page - 1 ) * $limit;

        #Tính tổng số Row
        $numRows = $this->recruitmentModel->num();
        $sumPage = ceil($numRows / $limit);

        $data['recruitments'] = $this->recruitmentModel->get($limit, $offset);
        $data['template'] = 'recruitment/list';
        $data['page'] = page($sumPage, '/admin/recruitment/lists');

        return $this->loadView('admin/main', $data);
    }

    public function edit($id = 0)
    {
        $recruitment = $this->recruitmentModel->show($id);
        if ($recruitment) {
            $data['title'] = 'Chỉnh Sửa Vị Trí Tuyển Dụng ' . $recruitment['title'];
            $data['recruitment'] = $recruitment;
            $data['template'] = 'recruitment/edit';

            return $this->loadView('admin/main', $data);
        }

        Helper::flash('errors', 'ID không tồn tại');
        return Helper::redirect('admin/recruitment/lists');
    }
    

    public function update($id = 0)
    {
        if (isset($_POST['update'])) {
            #Kiểm tra Id có tồn tại trong data hay không
            $recruitment = $this->recruitmentModel->show($id);
            if ($recruitment) {

                $title = isset($_POST['title']) ? Helper::makeSafe($_POST['title']) : '';
                $content = isset($_POST['content']) ? Helper::makeSafe($_POST['content']) : '';
                $active = isset($_POST['active']) ? intval($_POST['active']) : 1;

                if ($title == '') {
                    Helper::flash('errors', 'Vui lòng nhập tiêu đề Vị Trí Tuyển Dụng');
                    return Helper::redirect('admin/recruitment/edit/' . $id);
                }

                $result = $this->recruitmentModel->update($title, $content, $active, $id);
                if ($result) {
                    Helper::flash('success', 'Cập nhật Vị Trí Tuyển Dụng thành công');
                    return Helper::redirect('admin/recruitment/lists');
                }

                Helper::flash('errors', 'Cập nhật Vị Trí Tuyển Dụng Lỗi');
                return Helper::redirect('admin/recruitment/edit/' . $id);
            }

            Helper::flash('errors', 'ID không tồn tại');
            return Helper::redirect('admin/recruitment/lists');
        }

        return Helper::redirect('admin/recruitment/lists');
    }

    public function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

            $recruitment = $this->RecruitmentModel->show($id);
            if ($recruitment) {

                $delete = $this->RecruitmentModel->remove($id);
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
