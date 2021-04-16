<?php

class InfoModel extends DB
{
    public function getRecruitment(int $id)
    {
        $sql = "SELECT id, title from recruitment
            where active = 1 && id = " . $id ;
        
        return $this->fetch($sql);
    }

    public function addRecruitment($ar)
    {
        $sql = "INSERT into recruitment_staff 
            (name, recruitment_id, phone, email, content, thumb, cv, time_create, is_view) 
            values ('". $ar['name'] ."', ". $ar['recruitment_id'] .", ". $ar['phone'] .", 
            '". $ar['email'] ."', '". $ar['content'] ."', '". $ar['thumb'] ."', '". $ar['cv'] ."', ". $ar['time_create'] .",   
            ". $ar['is_view'] . ") ";


            return $this->query($sql);
    }

    
}