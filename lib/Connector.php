<?php

/**
 * Class Connector
 */
final class Connector
{

    /**
     * @var PDO
     */
    private $db;

    public $dbName;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {

        $dsn = 'mysql:dbname=' . $config['db'] . ';host=' . $config['host'] . ';port=' . $config['port'];
        try {
            $this->db = new PDO($dsn, $config['user'], $config['pass']);
            $this->dbName = $config['db'];
        } catch (PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
        }
    }

    /**
     * @param $db string
     * @return array
     * @throws Exception
     */
    public function getTables($db)
    {

        $sql = "SHOW TABLES FROM {$db}";
        $rows = $this->query($sql);
        $result = [];
        foreach ($rows as $row) {
            $result[] = $row['Tables_in_' . $db];
        }
        return $result;
    }

    /**
     * @param $table string
     * @return array
     * @throws Exception
     */
    public function getColumns($table)
    {
        $sql = "SHOW COLUMNS FROM {$table}";
        return $this->query($sql);
    }

    /**
     * @param $sql string
     * @return array
     * @throws Exception
     */
    public function query($sql)
    {
        $query = $this->db->query($sql, PDO::FETCH_ASSOC);
        if ($query === false) {
            throw new Exception(implode(';', $this->db->errorInfo()));
        }
        return $query->fetchAll();
    }

    /**
     * @param $sql string
     */
    public function insert($sql)
    {

    }

}