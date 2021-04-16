<?php

class ProductSliderModel extends DB
{
    public function getProduct()
    {
        return $this->query("select * from products where active = 1");
    }

    public function insert($ar)
    {
        $sql = "insert into product_slider (url, product_id, active) 
            values ('". $ar['url'] ."', ". $ar['product_id'] .", ". $ar['active'] .") ";
            
        return $this->query($sql);
    }

    public function num()
    {
        $sql = 'select id from product_slider';

        return $this->numRows($sql);
    }


    public function get($limit, $offset)
    {
        $sql = 'SELECT product_slider.id, product_slider.url, product_slider.active, 
                products.title as product_title 
                from product_slider JOIN products on products.id = product_slider.product_id  
                order by id desc limit ' . $limit .' offset '. $offset;

        return $this->query($sql);
    }

    public function show($id)
    {
        $sql = 'SELECT * from product_slider where id = ' . $id;

        return $this->fetch($sql);
    }

    public function update($ar, $id)
    {
        $sql = "UPDATE product_slider set 
            product_id = ". $ar['product_id'] .", active = ". $ar['active'];
        
        if (isset($ar['url']) && $ar['url'] != '/') {
            $sql .= " , url = '". $ar['url'] ."'" ;
        }
            
        $sql .=" where id = " . $id;

        return $this->query($sql);
    }

    public function remove($id)
    {
        return $this->query('delete from product_slider where id = ' . $id);
    }
}