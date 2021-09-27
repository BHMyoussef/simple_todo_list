<?php
    require "task.php";
    $tasks=getTasks();
    $listedTasks=$tasks;
    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(isset($_POST['task'])){
            $newTask=$_POST["task"];
            addTask($newTask);
            header("location:index.php");
            $listedTasks=$tasks;
        }
        if(isset($_POST['finished'])){
            $ids=explode(",",$_POST['finished']);
            $listedTasks=[];
            foreach($tasks as $task){
                if(in_array($task['id'],$ids))
                    array_push($listedTasks,$task);
            }
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Stick+No+Bills:wght@700&display=swap" rel="stylesheet">
    <!-- style -->
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <!-- script -->
    <script src="inndex.js"></script>
</head>
<body>
    <div class="container">
        <div>
            <h1>ToDo list</h1>
            <form action="" method="POST">
                <div id="input-div">
                    <input type="text" name="task" placeholder="add a task">
                    <button>add</button>
                </div>
            </form>
            <div id="todos">
                <?php foreach($listedTasks as $task): ?>
                    <div>
                        <input type="checkbox" class="checkbox <?php if($task['checked']) {echo "checked" ;}else echo ""; ?>" onchange="handleCheckboxChange(event)" <?php if($task['checked']) {echo "checked" ;} ?> id=<?php echo $task['id'] ?>>
                        <input type="text" name="task" class="task" value="<?php echo $task['titel'] ?>" disabled />
                        <form action="delete.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $task['id'] ?>">
                            <button>delete</button>
                        </form>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="buttons">
                <form method="POST">
                    <input type="hidden" name="all" id="all">
                    <button onclick="getSelectedTask()"
                        >All</button>
                </form>
                <form method="POST">
                    <input type="hidden" name="finished" id="finished">
                    <button onclick="getSelectedTask()"
                        >Finished</button>
                </form>
                <form method="POST" action="delete.php">
                    <input type="hidden" name="multipl_id" id="multipl_id">
                    <button onclick="getSelectedTask()"
                        >delete</button>
                </form>
                
            </div>
        </div>
    </div>
</body>
</html>