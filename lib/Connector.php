<?php

final class Connector {

    private $db;

    public function __construct(array $config) {

        $dsn = 'mysql:dbname='.$config['db'].';host='.$config['host'].';port='.$config['port'];
        try {
            $this->db = new PDO($dsn, $config['user'], $config['pass']);
        } catch (PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
        }
    }

    public function getTables($db) {

        $sql = "SHOW TABLES FROM {$db}";
        $rows = $this->query($sql);
        $result = [];
        foreach($rows as $row) {
            $result[] = $row['Tables_in_'.$db];
        }
        return $result;
    }

    public function getColumns($table) {
        $sql = "SHOW COLUMNS FROM {$table}";
        return $this->query($sql);
    }

    public function query($sql) {
        $query = $this->db->query($sql, PDO::FETCH_ASSOC);
        if($query === false) {
            throw new Exception(implode(';', $this->db->errorInfo()));
        }
        return $query->fetchAll();
    }

    public function parseColumn(array $column) {

        $info = new ColumnInfo();
        $info->parseName($column['Field']);
        $info->parseType($column['Type']);
        $info->parseLength($column['Type']);
        $info->parseNull($column['Null']);
        $info->parseDefault($column['Default']);
        $info->parseAutoIncrement($column['Extra']);
        $info->parseUnique($column['Extra']);
        $info->parsePrimaryKey($column['Key']);
        //$info->parseForeignKey($column['Key']);

        return $info;
    }

    public function parse(array $columns) {

        $data = [];
        foreach($columns as $column) {
            $data[] = $this->parseColumn($column);
        }

        return $data;
    }

}