 ﻿<?php
require_once 'cconf.php';

class sqlprovider {

    var $conexion;
    var $resource;
    var $sql;
    var $queries;
    var $singleton;

    /* var $dbname = $BD_NAME; */

    function getInstance() {

        if (isset($this->singleton)) {
            $this->$singleton = new DataBase();
        }
        return $this->singleton;
    }

    function execute() {
        try {
            //echo "execute".Conf::HOSTNAME."--".Conf::DB_USER."---". Conf::DB_PASS;
            $this->conexion = mysql_connect(Conf::HOSTNAME, Conf::DB_USER, Conf::DB_PASS);
 // echo "mysql_error<br/>" . mysql_error();
  //echo $this->conexion;
            mysql_select_db(Conf::DB_NAME, $this->conexion);
            $this->queries = 0;
            $this->resource = null;
            // mysql_query("SET NAMES 'utf8'", $this->conexion);
            if (!($this->resource = mysql_query($this->sql, $this->conexion))) {
                echo "mysql_error<br/>" . mysql_error();
                //$error = new Errors();
                //$error->SendMysqlErrorMessage(mysql_error(), "csqlprovider.php", "execute", $this->sql);
                return null;
            }
            $this->queries++;
            return $this->resource;
        } catch (Exception $ex) {
            echo "error en la conexion<br/>";
            //$error = new Errors();
            //$error->SendMysqlErrorMessage(mysql_error(), "csqlprovider.php", "execute", $this->sql);
        }
        return null;
    }

    function update() {
        // echo $this->sql;
        if (!($this->resource = mysql_query($this->sql, $this->conexion))) {
            $error = new Errors();
            $error->SendMysqlErrorMessage(mysql_error(), "csqlprovider.php", "update", $this->sql);
            return false;
        }
        return true;
    }

    function ListArray() {
        if (!($cur = $this->execute())) {

            return null;
        }
        $array = array();
        while ($row = @mysql_fetch_array($cur)) {
            $array[] = $row;
        }
        return $array;
    }

    function ListObject() {

        if (!($cur = $this->execute())) {

            return null;
        }

        $array = array();
        while ($row = @mysql_fetch_object($cur)) {
            array_push($array, $row);
        }
        return $array;
    }

    function ListObject2() {
        if (!($cur = $this->execute())) {

            return null;
        }

        $array = array();
        while ($row = @mysql_fetch_row($cur)) {
            array_push($array, $row);
        }
        return $array;
    }

    function setQuery($sql) {
        if (empty($sql)) {
            return false;
        }
        $this->sql = $sql;
        return true;
    }

    function freeResults() {
        @mysql_free_result($this->resource);
        return true;
    }

    function getObject() {
        if ($cur = $this->execute()) {
            if ($object = mysql_fetch_object($cur)) {
                @mysql_free_result($cur);
                return $object;
            } else {
                $error = new Errors();
                $error->SendMysqlErrorMessage(mysql_error(), "csqlprovider.php", "getObject", $this->sql);
                return null;
            }
        } else {
            return false;
        }
    }

    function CloseMysql() {
        @mysql_free_result($this->resource);
        @mysql_close($this->conexion);
    }

}
?>