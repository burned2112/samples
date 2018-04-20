<?php
class select extends datebase
{
	private $tablename;

	function __construct($tablename)
	{
		$this->tablename = $tablename;
		$this->connectToDb();
	}

	function select()
	{
		$query = mysql_query("SELECT * FROM $this->tablename");
		for($i=0;$i<mysql_num_rows($query);$i++)
		{
			$result[$i] = mysql_fetch_array($query);
		}
		
		return $result;
	}

	function select_unlimit($by_select)
	{
		$query = mysql_query("SELECT * FROM $this->tablename ORDER BY `$by_select` DESC");
		for($i=0;$i<mysql_num_rows($query);$i++)
		{
			$result[$i] = mysql_fetch_array($query);
		}
		
		return $result;
	}

	function selectBylimit()
	{
		$query = mysql_query("SELECT * FROM $this->tablename ORDER BY `id` DESC LIMIT 0,10");
		for($i=0;$i<mysql_num_rows($query);$i++)
		{
			$result[$i] = mysql_fetch_array($query);
		}
		
		return $result;
	}


	function selectByidImg($id)
	{
		$query = mysql_query("SELECT * FROM $this->tablename WHERE `id` = '$id'");
		$result = mysql_fetch_array($query);
		return $result;
	}


	function selectbydate($date)
	{
		$query = mysql_query("SELECT * FROM $this->tablename WHERE `date` like '$date'");
		for($i=0;$i<mysql_num_rows($query);$i++)
		{
			$result[$i] = mysql_fetch_array($query);
		}
		
		return $result;
	}

	function eventbyyear($variable)
	{
		$query = mysql_query("SELECT * FROM $this->tablename WHERE `year` = '$variable'");
		for($i=0;$i<mysql_num_rows($query);$i++)
		{
			$result[$i] = mysql_fetch_array($query);
		}

		return $result;
	}
	function selectByid($id)
	{
		$query = mysql_query("SELECT * FROM $this->tablename WHERE `id` = '$id'");
		$result = mysql_fetch_array($query);
		return $result;
	}

	function selectCommentByid_news($id)
	{
		$query = mysql_query("SELECT * FROM $this->tablename WHERE `id_news` = '$id' GROUP BY `id` DESC");
		for($i=0;$i<mysql_num_rows($query);$i++)
		{
			$result[$i] = mysql_fetch_array($query);
		}
		return $result;
	}

	function last_DO()
	{
		$query = mysql_query("SELECT * FROM $this->tablename GROUP BY `id` DESC");
		$result = mysql_fetch_array($query);
		return $result;
	}

	function selectByLogin($login)
	{
		$query = mysql_query("SELECT * FROM $this->tablename WHERE `login` = '$login'");
		$result = mysql_fetch_array($query);
		return $result;
	}
	function selectUser($login)
	{
		$query = mysql_query("SELECT * FROM $this->tablename WHERE `login` = '$login'");
		for($i=0;$i<mysql_num_rows($query);$i++)
		{
			$result[$i] = mysql_fetch_array($query);
		}
		
		return $result;
	}

	function authorisation($login,$password)
	{
		$select = "SELECT * FROM $this->tablename WHERE `login` = '$login' && `password` = '$password'";
		$query = mysql_query($select);
		$result = mysql_fetch_array($query);
		return $result;
	}

	function search($string,$search)
	{
		$query = mysql_query("SELECT * FROM $this->tablename WHERE `$string` LIKE '%$search%'");
		for($i=0;$i<mysql_num_rows($query);$i++)
		{
			$result[$i] = mysql_fetch_array($query);
		}
		
		return $result;		
	}

	function select_popular()
	{
		$query = mysql_query("SELECT * FROM $this->tablename WHERE `watch` like (SELECT max(`watch`) FROM $this->tablename) ORDER BY `id`");
		for($i=0;$i<mysql_num_rows($query);$i++)
		{
			$result[$i] = mysql_fetch_array($query);
		}
		return $result;
	}
}


class insert extends datebase 
{
	private $tablename;
	private $inf;

	function __construct($tablename,$inf)
	{
		$this->inf = $inf;
		$this->tablename = $tablename;
		$this->connectToDb();
 
	}

	function insertTobd()
	{
		$query = "INSERT INTO $this->tablename" OR die(mysql_error());

		foreach ($this->inf as $key => $value) 
		{
			$keys[]=$key;
			$values[]=$value;
		}
		$query.="(`".implode($keys, "`,`")."`) VALUES";
		$query.="('".implode($values,"','")."')";
		$sql = mysql_query($query) or die(mysql_error());

	}
}

class delete extends datebase 
{
	private $tablename;

	function __construct($tablename)
	{
		$this->tablename = $tablename;
		$this->connectToDb();
 
	}

	function deleteTobd($id)
	{
		$query = "DELETE FROM $this->tablename WHERE `id` = '$id'";
		$result = mysql_query($query);
	}
}



class update extends datebase
{
	private $tablename;

	function __construct($tablename)
	{
		$this->tablename = $tablename;
		$this->connectToDb();
	}

	function increment($varible,$id)
	{
		$query = mysql_query("UPDATE $this->tablename SET `$varible` = `$varible` + 1 WHERE `id` = $id") or die(mysql_error());
		
	}

	function decrement($varible,$id)
	{
		$query = mysql_query("UPDATE $this->tablename SET `$varible` = `$varible` - 1 WHERE `id` = $id") or die(mysql_error());
		
	}
}
?>