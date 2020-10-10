<?php 

namespace SenhaEletronica\Model; 

class Sql{

    private $conn;

    const DB_HOST = "localhost";
    const DB_PORT = "3306";
    const DB_NAME = "senha_eletronica";
    const DB_USER = "root";
    const DB_PASS = "";
        
    public function __construct()
    {
        try {
            $this->conn = new \PDO("mysql:host=". Sql::DB_HOST . ";dbname=". Sql::DB_NAME .";port=". Sql::DB_PORT , Sql::DB_USER, Sql::DB_PASS, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
              ]);
        } catch (\PDOException $e) {
            throw new \Exception(
                "Erro: ".$e->getMessage(). "\n".    
                "Code: ".$e->getCode().
                "File: ".$e->getFile().
                "Line: ".$e->getLine()
            );
        }
        
    }

    private function setParams($stmt, $parameters = array())
	{
		foreach ($parameters as $key => $value) {
			$this->bindParam($stmt, $key, $value);
		}
	}

	private function bindParam($stmt, $key, $value)
	{
		$stmt->bindParam($key, $value);
	}

    public function query($query, array $data)
    {
        $stmt = $this->conn->prepare($query);
		$this->setParams($stmt, $data);
        return $stmt->execute();
        
    }

    public function select($query, array $data = [])
    {
        $stmt = $this->conn->prepare($query);
		$this->setParams($stmt, $data);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}