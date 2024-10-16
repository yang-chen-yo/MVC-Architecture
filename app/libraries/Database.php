<?php

class Database
{
    private string $type = DB_TYPE;
    private string $host = DB_HOST;
    private string $port = DB_PORT;
    private string $dbname = DB_NAME;
    private string $user = DB_USER;
    private string $pass = DB_PASS;

    private PDO $dbh;
    private PDOStatement $stmt;

    public function __construct()
    {
        try {
            $this->dbh = new PDO("$this->type:host=$this->host;port=$this->port;dbname=$this->dbname", $this->user, $this->pass);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function query(string $query): void
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind(string $param, mixed $value, int $type = null): void
    {
        if (is_null($type)) {
            $type = match (true) {
                is_int($value) => PDO::PARAM_INT,
                is_null($value) => PDO::PARAM_NULL,
                is_bool($value) => PDO::PARAM_BOOL,
                default => PDO::PARAM_STR,
            };
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute(): bool
    {
        return $this->stmt->execute();
    }

    public function getAll(): bool|array
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSingle(): mixed
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRowCount(): int
    {
        $this->execute();
        return $this->stmt->rowCount();
    }
}