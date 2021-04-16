<?php

class ContactController extends Controller
{
    public function show()
    {
        $data['title'] = 'Liên hệ chi tiết';
        $data['template'] = 'contact/contact';

        return $this->loadView('main', $data);
    }
}