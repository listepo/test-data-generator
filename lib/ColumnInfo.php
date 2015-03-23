<?php

class ColumnInfo {

    public $name;

    public $type;

    public $length;

    public $null;

    public $default;

    public $autoIncrement;

    public $unique;

    public $primaryKey;

//    public $foreignKey;

    public function parseName($data) {
        $this->name = $data;
    }

    public function parseType($data) {

    }

    public function parseLength($data) {

    }

    public function parseNull($data) {
        $this->null = $data === 'YES';
    }

    public function parseDefault($data) {
        $this->default = $data;
    }

    public function parseAutoIncrement($data) {
        $this->autoIncrement = $data === 'auto_increment';
    }

    public function parseUnique($data) {
        $this->unique = $data === 'UNI';
    }

    public function parsePrimaryKey($data) {
        $this->primaryKey = $data === 'PRI';
    }

//    public function parseForeignKey($data) {
//        $this->foreignKey = $data === '';
//    }
}