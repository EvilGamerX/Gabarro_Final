<?php
	/* Database class that holds details for login 
		and functions. 
		
		Jacked' from Gabarro's book.
		Transcriped by TJ
	*/ 
	
	class database
	{	private $link;
		private $res;
		private $host = "localhost";
		private $user = "tjhopweb";
		private $pass = "4CS546web";
		private $db;
		
		// sets user, pass, and host and connects
		public function setup($u, $p, $h, $db)
		{	$this->user = $u;
			$this->pass = $p;
			$this->host = $h;
			$this->db = $db;
			
			if (isset($this->link))
				$this->disconnect();
				
			$this->connect();
		}
	
		// chances the db in which all queries will be 
		// performed
		public function pick_db($db)
		{	$this->db = $db;
		}
	
		// destructor disconnects
		public function __destruct()
		{	$this->disconnect();
		}
	
		// closes the connect to db
		public function disconnect()
		{	if (isset($this->link))
				mysql_close($this->link);
			
			unset($this->link);
		}
	
		// connects to the db or disconnects/reconnects if
		// a connection already exists
		public function connect()
		{	if (! isset($this->link))
			{	try 
				{	if (! $this->link = mysql_connect($this->host, $this->user, $this->pass))
						throw new Exception("Cannot connect to " . $this->host);
				}
				catch (Exception $e)
				{	echo $e->getMessage();
					exit;
				}
			}
			
			else 
			{	$this->disconnect();
				$this->connect();
			}
		}
	
		// send a sql query
		public function send_sql($sql)
		{	if (! isset($this->link))
				$this->connect();
			
			$sql = addslashes($sql);
				
			try
			{	if (! $succ = mysql_select_db($this->db))
					throw new Exception("Could not select the database " . $this->db);
					
				if (! $this->res = mysql_query($sql, $this->link))
					throw new Exception("Could not send query");
			}
			catch (Exception $e)
			{	echo $e->getMessage() . "<br/>";
				echo mysql_error();
				exit;
			}
		
			return $this->res;
		}
	
		// shows the contents of the result as a table
		public function printout()
		{	if (isset($this->res) && (mysql_num_rows($this->res) > 0))
			{	mysql_data_seek($this->res, 0);
				$num = mysql_num_fields($this->res);

				echo "<table border=1>";
				echo "<tr>";
				
				for ($i = 0; $i < $num; $i++)
				{	echo "<th>";
					echo mysql_field_name($this->res, $i);
					echo "</th>";
				}
				echo "</tr>";
				
				while ($row = mysql_fetch_row($this->res))
				{	echo "<tr>";
					
					foreach($row as $elem)
					{	echo "<td>$elem</td>";
					}
					
					echo "</tr>";
				}
			
				echo "</table>";				
			}
		
			else 
				echo "There is nothing to print! <br />";
		}
	
		// returns an array with the next row
		public function next_row()
		{	if (isset($this->res))
			{	return mysql_fetch_row($this->res);
			}	
			echo "You need to make a query first! <br />";
			return false;			
		}
	
		// returns the last auto_increment data created
		public function insert_id()
		{	if (isset($this->link))
			{	$id = mysql_insert_id($this->link);
			
				if ($id == 0)
					echo "You did not insert an element that caused an auto-increment id to be created! <br />";
					
				return $id;
			}
		
			echo "You are not connected to the database! <br/>";
			return false;
		}
	
		// creates a new db and selects it
		public function new_db($name)
		{	if (! isset($this->link))
				$this->connect();
				
			$query = "CREATE DATABASE IF NOT EXISTS " . $name;
			
			try
			{	if (mysql_query($query, $this->link))
					throw new Exception("Cannot create database " . $name);
					
				$this->db = $name;
			}
			catch (Exception $e)
			{	echo $e->getMessage() . "<br/>";
				echo mysql_error();
				exit;
			}
		}
	}

	/* 	Example php file on how to use this database class.
			NOTHING AFTER HERE IS ACTUAL CODE FOR THE CLASS
			
			<?php
				include ("./db_class.php");
				
				$db = new database();
				$db->setup("dbuser", "dbpass", "dbhost", "dbname");
				$query = "SELECT * FROM user";
				$res = $db->send_sql($query);
				echo "Found ".mysql_num_rows($res) . " rows <br/>";
				$row = $db->next_row();
				echo $row[0] . "<br/>";
				$row = $db->next_row();
				echo $row[1] . "<br/>";
				$db->printout();
				$db->insert_id();
				$db->new_db("testing");
				$db->disconnect();
				$db->insert_id();
			?>
	*/
?>