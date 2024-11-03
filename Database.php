<?php

class Database
{
    private $db;

    public function __construct($config)
    {
        $this->db = new PDO($this->getDsn($config));
    }

    private function getDsn($config)
    {
        $drive = $config['driver'];
        unset($config['driver']);

        $dsn = $drive . ':' . http_build_query($config, '', ';');

        if ($drive == 'sqlite') {
            $dsn = $drive . ':' . $config['database'];
        }

        return $dsn;
    }

    public function query($query, $class = null, $params = [])
    {
        $prepare = $this->db->prepare($query);

        if ($class) {
            $prepare->setFetchMode(PDO::FETCH_CLASS, $class);
        }

        $prepare->execute($params);
        return $prepare;
    }
}

$database = new Database(config('database'));
