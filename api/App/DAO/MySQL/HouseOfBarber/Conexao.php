<?php 
    namespace App\DAO\MySQL\HouseOfBarber;

    use PDOException;

    abstract class Conexao{
        protected $pdo;

        public function __construct()
        {
            $host = getenv("HOUSE_OF_BARBER_HOST");
            $dbName = getenv("HOUSE_OF_BARBER_DBNAME");
            $username = getenv("HOUSE_OF_BARBER_USER");
            $password = getenv("HOUSE_OF_BARBER_PASSWORD");
            $port = getenv("HOUSE_OF_BARBER_PORT");

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