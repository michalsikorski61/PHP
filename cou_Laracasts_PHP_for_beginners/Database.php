<?php
class Database{

    public $connection;
    public function __construct()
    {
        $config = [
            'host' => 'localhost',
            'port' => 3306,
            'dbname' => 'serwer90089_laracastcphpbeggine',
            'charset' => 'utf8mb4'
        ];
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};user=serwer90089_laracastcphpbeggine;password=;charset={$config['charset']}";
        
        $this->connection = new PDO($dsn,'serwer90089_laracastcphpbeggine','GR@vo87PQdXgMiJ9',[
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]); //data source name (a str that dsdeclares connection to the db)
    }


    public function query($query){
        //connect to MySQL database
       

        $statement = $this->connection->prepare($query);

        $statement->execute();

        return $statement;

    }
}