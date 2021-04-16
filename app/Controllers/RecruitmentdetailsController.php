<?php

class RecruitmentdetailsController extends Controller
{
    protected $recruitmentdetailsModel;
    
    public function __construct()
    {
        $this->recruitmentdetailsModel = $this->loadModel('RecruitmentdetailsModel');
    }

    public function view($id = 0)
    {
        $recruitmentdetail = $this->recruitmentdetailsModel->show($id);

         if ($recruitmentdetail) {
            $data['title'] = Helper::decodeSafe($recruitmentdetail['title']);
            $data['template'] = 'recruitment/content';
            $data['recruitmentdetail'] =  $recruitmentdetail;
            
            return $this->loadView('main', $data);
        }

        return Helper::redirect();
    }

}