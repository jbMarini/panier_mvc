<?php

class Movie extends Model
{
    public function __construct()
    {
        parent:: __construct();
        $this->_setTable('movies');
    }

    public function fetchOneTmdb($id_TMDb)
	{
		$sql = 'select * from ' . $this->_table;
		$sql .= ' where id_TMDb = ?';
		
		$statement = $this->_dbh->prepare($sql);
		$statement->execute(array($id_TMDb));
		
		return $statement->fetch(PDO::FETCH_OBJ);
	}

	public function searchByLetter($letter, $fetchType=PDO::FETCH_OBJ)
	{
		if($letter == ''){
			$sql = 'select * from ' . $this->_table; 
			$sql .= ' where upper(substring(name from 1 for 1)) not between "A" and "Z"';
		}else{
			$sql = 'select * from ' . $this->_table;
			$sql .= ' where name like "'.$letter.'%"';
		}
		$statement = $this->_dbh->prepare($sql);
        $statement->execute();
        return $statement->fetchAll($fetchType);
	}

	public function searchByTitle($title)
    {
        $sql = 'select * from ' . $this->_table;
        $sql .= ' where name like ? ';
		
		$statement = $this->_dbh->prepare($sql);
		$statement->execute(array('%'.$title. '%'));
		
		return $statement->fetchAll(PDO::FETCH_OBJ);
    }
}