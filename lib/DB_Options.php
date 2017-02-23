<?php


class DB_Options
{
private $_dbname,$_dbpassword,$_dbhost;
private $sql=array("from"=>"",
        "where"=>"",
        "order"=>"",
        "limit"=>""
    );
private $tablename;
    private $insert=array(
        "tablename"=>array(),
        "column"=>array()
    );
public function __construct()
    {
       $this->_dbname='OlFgSNSuFAwTZJwqhVuU';
        $this->_dbpassword='5dd3981f872f4477b897cb63f1e43410';
        $this->_dbhost='sqld.duapp.com';
       try {
           $pdo=new PDO("mysql:host=$this->_dbhost;port=4050;dbname=$this->_dbname", "da49132671114ca2ae83f45b1614bf75", "$this->_dbpassword");
           $pdo->setAttribute(PDO::ATTR_PERSISTENT,true);
       }
       catch(PDOException $e)
       {
           echo "<br>" . $e->getMessage();
       }
    }
//建立新对象时链接数据库
public function from($tablename)
{
    $this->sql['from']='FROM'.$tablename;
    return $this;
}
public function where($_where='1=1')
{
    $this->sql['where']='WHERE'.$_where;
    return $this;
}
public function select($_select)
{
    try {
        $pdo = new PDO("mysql:host=$this->_dbhost;port:4050;dbname=$this->_dbname", "root", "$this->_dbpassword");
        $sql="SELECT" . $_select . ' ' . (implode(' ', $this->sql));
        $res=$pdo->query($sql);
        if ($res) {
           $result=$res->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return 0;
        }
    }
    catch(PDOException $e)
    {
        echo "<br>" . $e->getMessage();
    }
}
//搜索操作
    public function column()
    {
        $this->insert["column"]= func_get_args();
        return $this;
    }
    public function table()
    {
        $this->insert["tablename"]= func_get_args();
        return $this;
    }

public function insert()
{
    $source=func_get_args();
    try {
        $pdo = new PDO("mysql:host=$this->_dbhost;port:4050;dbname=$this->_dbname", "root", "$this->_dbpassword");
        $sql="INSERT INTO ".implode('',$this->insert['tablename'])."(".implode(',',$this->insert['column']).")"." VALUES"." "."(". (implode(',',$source)).")";
        if ($pdo->exec($sql)) {
            return 1;
        } else {
            return 0;
        }
    }
    catch(PDOException $e)
    {
        echo  $e->getMessage();
    }
}
//插入操作
public function count()
{
try{
    $pdo = new PDO("mysql:host=$this->_dbhost;port:4050;dbname=$this->_dbname", "root", "$this->_dbpassword");
    $sql= $sql="'SELECT COUNT(*)FROM '.$this->tablename";
    $res=$pdo->query($sql);
    $num=$res->columnCount();
    return $num;
}
catch(PDOException $e)
{
    echo  $e->getMessage();
}
}
//返回数据表中总记录数

    public function fetch_table()
    {
        try{
            $pdo = new PDO("mysql:host=$this->_dbhost;port:4050;dbname=$this->_dbname", "root", "$this->_dbpassword");
            $sql="'SELECT COUNT(*)FROM '.$this->tablename";
            $res=$pdo->query($sql);
            $result=$res->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        catch(PDOException $e)
        {
            echo  $e->getMessage();
        }
    }
    //取出数据表
}