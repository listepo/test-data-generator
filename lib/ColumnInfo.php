<?php

/**
 * Class ColumnInfo
 */
class ColumnInfo
{

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $length;

    /**
     * @var bool
     */
    public $null;

    /**
     * @var string
     */
    public $default;

    /**
     * @var bool
     */
    public $autoIncrement;

    /**
     * @var bool
     */
    public $unique;

    /**
     * @var bool
     */
    public $primaryKey;

    /**
     * @var bool
     */
    public $unsigned;

    /**
     * @var bool
     */
    public $zerofill;

    /**
     * @param string $data
     */
    public function parseName($data)
    {
        $this->name = $data;
    }

    /**
     * @param string $data
     */
    public function parseType($data)
    {
        $data = str_split($data);
        $type = [];
        foreach ($data as $word) {
            if ($word === '(') {
                break;
            }

            if (ctype_alpha($word)) {
                $type[] = $word;
            }
        }
        $this->type = implode('', $type);
    }

    /**
     * @param $data
     */
    public function parseLength($data)
    {
        $data = str_replace($this->type, '', $data);
        $data = str_split($data);
        $type = [];
        foreach ($data as $word) {
            if ($word === ' ') {
                break;
            }

            if (!in_array($word, ['(', ')'])) {
                $type[] = $word;
            }
        }
        $this->length = implode('', $type);
    }

    /**
     * @param $data
     */
    public function parseNull($data)
    {
        $this->null = $data === 'YES';
    }

    /**
     * @param $data
     */
    public function parseDefault($data)
    {
        $this->default = $data;
    }

    /**
     * @param $data
     */
    public function parseAutoIncrement($data)
    {
        $this->autoIncrement = $data === 'auto_increment';
    }

    /**
     * @param $data
     */
    public function parseUnique($data)
    {
        $this->unique = $data === 'UNI';
    }

    /**
     * @param $data
     */
    public function parsePrimaryKey($data)
    {
        $this->primaryKey = $data === 'PRI';
    }

    /**
     * @param $data
     */
    public function parseUnsigned($data)
    {
        $this->unsigned = strpos($data, 'unsigned') !== false;
    }

    /**
     * @param $data
     */
    public function parseZerofill($data)
    {
        $this->zerofill = strpos($data, 'zerofill') !== false;
    }

    /**
     * @return bool
     */
    public function isAutoIncrement()
    {

        return $this->autoIncrement;

    }

}