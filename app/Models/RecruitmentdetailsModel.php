<?php

class RecruitmentdetailsModel extends DB
{
    public function get()
    {
        $sql = "SELECT id, title, content
                from recruitment where active = 1 order by id asc limit 20";

        return $this->query($sql);
    }

    public function show(int $id)
    {
        return $this->fetch("select * from recruitment where id = " . $id . "  && active = 1 ");
    }
}