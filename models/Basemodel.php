<?php
require_once '../../user_table_login.php';
class Model
{
	public $attributes = array();
	public static $dbc;
	protected static $table;

	public function __construct()
	{
		self::dbConnect();
	}

// Checks your connection
	public static function dbConnect()
	{
		if (!self::$dbc)
		{
			require '../../db_connect.php';
			self::$dbc = $dbc;
		} 

	}

// Gets the value from a certain key
	public function __get($key)
	{
		if (array_key_exists($key, $this->attributes)) {
			return $this->attributes[$key];
		}

		return null;
	}

// Sets the values into the attributes array
	public function __set($key, $value)
	{
		$this->attributes[$key] = $value;
	}

// Decides whether to update an entry or insert a new one
	public function save()
	{
		if (!empty($this->attributes)) 
		{
			self::dbConnect();

			if(isset($this->attributes['id'])) {
				$this->update($this->attributes['id']);
			} else {
				$this->insert();
			}
		}
	}

// Inserts a new entry into the database
	protected function insert() 
	{
		$insertkeyarray = [];
		$insertcolonarray = [];
		foreach ($this->attributes as $key => $value) {
			array_push($insertkeyarray, $key);
			$insertcolonarray[] = ":" . $key;
		}
		$insertkeyinfo = implode(', ', $insertkeyarray);
		$insertcoloninfo = implode(', ', $insertcolonarray);
		$stmt = self::$dbc->prepare('INSERT INTO ' . static::$table . ' (' . $insertkeyinfo . ') VALUES (' . $insertcoloninfo . ')');
		foreach ($this->attributes as $key => $value) {
			$stmt->bindValue(":" . $key, $value, PDO::PARAM_STR);
		}
		$stmt->execute();
	}

// Updates an existing entry
	protected function update($id)
	{	
		$updatedinfoarray = [];
        foreach ($this->attributes as $key => $value) {
            $update = $key . ' = :' . $key;
            array_push($updatedinfoarray, $update);
        }
        $updatedinfo = implode(', ', $updatedinfoarray);
        $stmt = self::$dbc->prepare('UPDATE ' . static::$table . ' SET ' . $updatedinfo . ' WHERE id = :id');
      
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        foreach ($this->attributes as $key => $value) {
            $stmt->bindValue(':' . $key, $value, PDO::PARAM_STR);
        }
        $stmt->execute();
	}

// Deletes all data with a set id
	public static function delete($id)
	{
		self::dbConnect();
		$stmt = self::$dbc->prepare('DELETE FROM ' . static::$table . ' WHERE id = :id');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
	}

// Retrieves all data from a set id
	public static function find($id)
	{
		self::dbConnect();
		$stmt = self::$dbc->prepare('SELECT * FROM ' . static::$table . ' WHERE id = :id');
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		$instance = null;
		if ($result)
		{
			$instance = new static;
			$instance->attributes = $result;
		}
		return $instance;
	}

// Selects all records in the table
	public static function all()
	{
		self::dbConnect();
		$stmt = self::$dbc->prepare('SELECT * FROM ' . static::$table . '');
		$stmt->execute();
		$allresults = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $allresults;
	}
}


?>