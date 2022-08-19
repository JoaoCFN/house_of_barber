<?php 
    namespace App\DAO\MySQL\HouseOfBarber;

    use PDOException;

    abstract class Conexao{
        protected $pdo;

        public function __construct()
        {
            // print_r($_ENV);
            $host = 'localhost';
            $dbName = 'house_of_barber';
            $username = 'root';
            $password = '';
            $port = 3306;

            $dsn = "mysql:host={$host};dbname={$dbName};port={$port}";

            try {
                $this->pdo = new \PDO($dsn, $username, $password);

                $this->pdo->setAttribute(
                    \PDO::ATTR_ERRMODE,
                    \PDO::ERRMODE_EXCEPTION
                );
            } 
            catch (PDOException $e) {
                echo $e->getMessage();

                exit;
            }
        }
    }