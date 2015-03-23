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

    public $unsigned;

    public $zerofill;

//    public $foreignKey;

    public function parseName($data) {
        $this->name = $data;
    }

    public function parseType($data) {
        $data = str_split($data);
        $type = [];
        foreach($data as $word) {
            if($word === ' '){
                break;
            }
            if(ctype_alpha($word)) {
                $type[] = $word;
            }
        }
        $this->type = implode('', $type);
    }

    public function parseLength($data) {
        $data = str_split($data);
        $type = [];
        foreach($data as $word) {
            if($word === ' '){
                break;
            }
            if(ctype_digit($word) || $word === ',') {
                $type[] = $word;
            }
        }
        $this->length = implode('', $type);
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

    public function parseUnsigned($data) {
        $this->unsigned = strpos($data, 'unsigned') !== false;
    }

    public function parseZerofill($data) {
        $this->zerofill = strpos($data, 'zerofill') !== false;
    }

//    public function parseForeignKey($data) {
//        $this->foreignKey = $data === '';
//    }
}