<?php

class UserModel extends DB
{
    public function login($email)
    {
        $sql = 'select * from users where email = "' . $email . '"';

        return $this->fetch($sql);
    }
}