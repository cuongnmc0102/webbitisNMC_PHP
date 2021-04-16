<?php

class RecruitmentModel extends DB
{
    public function insert($title, $content, $active)
    {
        $sql = "insert into recruitment (title, content, active, created_at) 
                values ('" . $title . "', '" . $content . "', " . $active . ", '" . date('Y-m-d H:i:s') . "') ";

        return $this->query($sql);
    }

    public function get($limit, $offset)
    {
        $sql = 'select * from recruitment order by id asc limit ' . $limit .' offset ' . $offset .'';

        return $this->query($sql);
    }

    public function num()
    {
        $sql = 'select id from recruitment';

        return $this->numRows($sql);
    }

    public function show($id)
    {
        $sql = 'select * from recruitment where id = ' . $id . '';

        return $this->fetch($sql);
    }

    public function  update($title, $content, $active, $id)
    {
        $sql = "update recruitment set title = '" . $title . "', content = '" . $content . "',
                                active = " . $active . " where id = " . $id . "";
        return $this->query($sql);                        
    }

    public function remove($id)
    {
        return $this->query("delete from recruitment where id = " . $id);
    }
}