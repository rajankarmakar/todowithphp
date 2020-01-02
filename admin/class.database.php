<?php
class Database{
    const HOST = "us-cdbr-iron-east-05.cleardb.net";
    const DB_NAME = "heroku_8975c2f17eb03d4";
    const DB_USER = "b6c7e56cf401ae";
    const DB_PASSWORD = "bbd9efdf";
    private $mySQLQueryString = "mysql:host=".self::HOST.";dbname=".self::DB_NAME;
    public $conn;
    public $task, $date;

    public function __construct()
    {
        try{
            $this->conn = new PDO($this->mySQLQueryString, self::DB_USER, self::DB_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e){
            echo "Database connection failed. Something went wrong ". $e->getMessage();
        }

    }

    public function insertTodo(){
        if(isset($_POST['submit'])){
            if(!empty($_POST['task']) && !empty($_POST['date']) ){
                $this->task = $_POST['task'];
                $this->date = $_POST['date'];
                $sql = "INSERT INTO task (task, date) VALUES (?, ?)";
                $result = $this->conn->prepare($sql)->execute([$this->task, $this->date]);
                if($result > 0){
                    echo "Congrats! Task added successfully";
                }
            }

        }
    }

    public function getTodo(){
        $sql = "SELECT * FROM task WHERE complete=0 ORDER BY date DESC";
        $result = $this->conn->prepare($sql);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchAll();
    }

    public function deleteTodo(){
        if(isset($_GET['delete'])){
            $sql = "DELETE FROM task WHERE id=".$_GET['delete'];
            $result = $this->conn->prepare($sql);
            $result->execute();
            header("Location:index.php");
        }
    }

    public function editItem(){
        if(isset($_GET['edit'])){
            $sql = "SELECT * FROM task WHERE ID=".$_GET['edit'];
            $result = $this->conn->prepare($sql);
            $result->execute();
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $final = $result->fetch();
            return $final;
        }
    }

    public function updateTodo(){
        if(isset($_POST['update'])){
            if(isset($_GET['edit'])){
                $update_sql = "UPDATE task SET task=?, date=? WHERE id=".$_GET['edit'];
                $update = $this->conn->prepare($update_sql);
                $update->execute([ $_POST['task'], $_POST['date'] ]);
                header("Location:index.php");
            }
        }
    }

    public function getCompleteTodo(){
            $sql = "SELECT * FROM task WHERE complete=1 ORDER BY date DESC";
            $result = $this->conn->prepare($sql);
            $result->execute();
            $result->setFetchMode(PDO::FETCH_ASSOC);
            return $result->fetchAll();
    }

    public function updateComplete(){
        if(isset($_GET['complete'])){
            $update_sql = "UPDATE task SET complete=? WHERE id=".$_GET['complete'];
            $update = $this->conn->prepare($update_sql);
            $update->execute([1]);
            header("Location:index.php");
        }
    }

    public function updateIncomplete(){
        if(isset($_GET['incomplete'])){
            $update_sql = "UPDATE task SET complete=? WHERE id=".$_GET['incomplete'];
            $update = $this->conn->prepare($update_sql);
            $update->execute([0]);
            header("Location:index.php");
        }
    }


}
$obj = new Database();
$obj->deleteTodo();
$obj->updateTodo();
$obj->updateComplete();
$obj->updateIncomplete();
