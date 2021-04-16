<?php

class SaleModel extends DB
{
    public function show()
    {
        $sql = 'SELECT * from products where sale_price != 0';

        return $this->fetch($sql);
    }

}