<?php

class RecruitmentController extends Controller
{
    protected $recruitmentModel;
    
    public function __construct()
    {
        $this->recruitmentModel = $this->loadModel('RecruitmentdetailsModel');
    }

    public function index()
    {
        $recruitment = $this->recruitmentModel->get();
        if ($recruitment) {
            $data['title'] = 'Cơ hội nghề nghiệp - Bitis NMC';
            $data['template'] = 'recruitment';
            $data['recruitments'] =  $recruitment;
            
            return $this->loadView('main', $data);
        }

        return Helper::redirect();
    }

}