<?php

class User extends Model
{
    public function __construct()
    {
        parent:: __construct();
        $this->_setTable('users');
    }

    public function checkLogin($login, $fetchType=PDO::FETCH_OBJ)
    {
        $sql = 'select * from users where login = ?';
        $statement = $this->_dbh->prepare($sql);
        $statement->execute(array($login));
        return $statement->fetch($fetchType);
    }

    public function checkMail($email, $fetchType=PDO::FETCH_OBJ)
    {
        $sql = 'select * from users where email = ?';
        $statement = $this->_dbh->prepare($sql);
        $statement->execute(array($email));
        return $statement->fetch($fetchType);
    }

    public function loginCheck($login, $password, $fetchType=PDO::FETCH_OBJ)
    {
        $sql = "select * from users where login = '$login' and password ='$password'";
        $statement = $this->_dbh->prepare($sql);
        $statement->execute();
        return $statement->fetch($fetchType);
    }
}