<?php
    require "task.php";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST['id'])){
            $id=$_POST['id'];
            deleteTaskById($id);
            header("location:index.php");
        }
        if(isset($_POST['multipl_id'])){
            $taskSelected=explode(",",$_POST['multipl_id']);
            deleteMultipleTask($taskSelected);
            header("location:index.php");
        }
    }
?>