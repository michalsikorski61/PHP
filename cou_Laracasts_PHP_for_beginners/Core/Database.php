<?php
class Database{

    public $connection;
    public $statement;
    public function __construct($config,$usr='root',$pass='')
    {
        

        $dsn = ('mysql:'.http_build_query($config,'',';')); // example.com?foo=bar&port=3306
        // $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};user=serwer90089_laracastcphpbeggine;password=;charset={$config['charset']}";
        
        $this->connection = new PDO($dsn,$usr,$pass,[
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]); //data source name (a str that dsdeclares connection to the db)
    }


    public function query($query,$params = []){
        //connect to MySQL database
       

        $this->statement = $this->connection->prepare($query); 

        $this->statement->execute($params);

        return $this;

    }

    public function get(){
        return $this->statement->fetchAll();
    }

    public function find(){
        return $this->statement->fetch();
    }

    public function findOrFail(){
        $result = $this->find();

        if(!$result){
            abort();
        }
        return $result;
    }
}