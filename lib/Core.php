<?php

/**
 * Class Core
 */
class Core
{

    /**
     * @var Connector
     */
    public $connector;

    /**
     * @param Connector $connector
     */
    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    /**
     * @param $rows
     */
    public function run($rows)
    {
        $connector = $this->connector;
        $tables = $connector->getTables($connector->dbName);
        foreach ($tables as $table) {
            $columns = $connector->getColumns($table);
            $data = $this->parse($columns);
            $sql = $this->generateSql($data, $table, $rows);
            $connector->insert($sql);
        }
    }

    /**
     * @param array $column
     * @return ColumnInfo
     */
    public function parseColumn(array $column)
    {

        $info = new ColumnInfo();
        $info->parseName($column['Field']);
        $info->parseType($column['Type']);
        $info->parseLength($column['Type']);
        $info->parseUnsigned($column['Type']);
        $info->parseZerofill($column['Type']);
        $info->parseNull($column['Null']);
        $info->parseDefault($column['Default']);
        $info->parseAutoIncrement($column['Extra']);
        $info->parseUnique($column['Extra']);
        $info->parsePrimaryKey($column['Key']);

        return $info;
    }

    /**
     * @param array $columns
     * @return ColumnInfo[]
     */
    public function parse(array $columns)
    {

        $data = [];
        foreach ($columns as $column) {
            $data[] = $this->parseColumn($column);
        }

        return $data;
    }

    /**
     * @param ColumnInfo $info
     * @param Column $column
     * @throws Exception
     * @return string|int
     */
    public function combineData(ColumnInfo $info, Column $column)
    {
        $method = 'get' . ucfirst($info->type);
        if (method_exists($column, $method)) {
            return $column->$method($info);
        } else {
            throw new Exception("Method {$method} not found");
        }
    }

    /**
     * @param ColumnInfo[] $data
     * @param $table
     * @param $rows
     * @return string
     */
    public function generateSQL(array $data, $table, $rows)
    {
        $column = new Column();
        $inserts = [];
        while ($rows > 0) {
            $rows--;
            $res = [];
            foreach ($data as $info) {
                if (!$info->isAutoIncrement()) {
                    $res[$info->name] = $this->combineData($info, $column);
                }
            }
            $inserts[] = $this->makeSQL($res, $table);
        }
        return implode(';', $inserts);
    }

    public function makeSQL(array $res, $table)
    {

        $columns = implode(',', array_keys($res));
        $values = implode(',', $res);
        return 'INSERT INTO ' . $table . ' (' . $columns . ') VALUES(' . $values . ')';
    }
}