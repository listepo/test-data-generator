DROP DATABASE IF EXISTS test;
CREATE DATABASE test;

USE test;

DROP TABLE IF EXISTS numeric_types;
CREATE TABLE numeric_types (
  col_bit BIT,
  col_tinyint TINYINT ZEROFILL,
  col_bool BOOL,
  col_boolean BOOlEAN,
  col_smallint SMALLINT,
  col_mediumint MEDIUMINT,
  col_integer INTEGER,
  col_bigint BIGINT,
  col_serial SERIAL,
  col_decimal DECIMAL,
  col_dec DEC,
  col_float FLOAT(3,2),
  col_double DOUBLE
);

DROP TABLE IF EXISTS datetime_types;
CREATE TABLE datetime_types (
  col_date DATE,
  col_datetime DATETIME,
  col_timestamp TIMESTAMP,
  col_time TIME,
  col_year YEAR
);

DROP TABLE IF EXISTS string_types;
CREATE TABLE string_types (
  col_char CHAR,
  col_nchar NCHAR,
  col_varcahr VARCHAR(250),
  col_nvarchar NATIONAL VARCHAR(20),
  col_binary BINARY,
  col_varbinary VARBINARY(23),
  col_tinyblob TINYBLOB,
  col_tinytext TINYTEXT,
  col_blob BLOB,
  col_text TEXT,
  col_mediumblob MEDIUMBLOB,
  col_mediumtext MEDIUMTEXT,
  col_longblob LONGBLOB,
  col_longtext LONGTEXT,
  col_enum ENUM('value1', 'value2'),
  col_set SET('value1', 'value2')
);