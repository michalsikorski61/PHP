<?php
class Database{

    public $connection;
    public function __construct($config,$usr='serwer90089_laracastcphpbeggine',$pass='>7K=><mN%YOEQ-kh')
    {
        

        $dsn = ('mysql:'.http_build_query($config,'',';')); // example.com?foo=bar&port=3306
        // $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};user=serwer90089_laracastcphpbeggine;password=;charset={$config['charset']}";
        
        $this->connection = new PDO($dsn,$usr,$pass,[
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]); //data source name (a str that dsdeclares connection to the db)
    }


    public function query($query,$params = []){
        //connect to MySQL database
       

        $statement = $this->connection->prepare($query); 

        $statement->execute($params);

        return $statement;

    }
}