<?php

class RecruitmentModel extends DB
{
    public function get()
    {
        $sql = "SELECT id, title, content
                from recruitment where active = 1 order by id asc limit 20";

        return $this->query($sql);
    }
    
}