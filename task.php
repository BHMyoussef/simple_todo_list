<?php
    function getTasks(){
        $tasks=json_decode(file_get_contents("task.json"),true) ;
        return $tasks;
    }
    function addTask($t){
        $tasks=getTasks();
        $lastTask=end($tasks);
        echo $lastTask['id'];
        $newTask=[
            'id'=>$lastTask['id']+1,
            'titel'=>$t,
            'checked'=>false
        ];
        array_push($tasks,$newTask);
        addIntoJson($tasks);
    }
    function deleteTaskById($id){
        $tasks=getTasks();
        foreach($tasks as $key=>$task){
            if($task['id']==$id){
                array_splice($tasks,$key,1);
                addIntoJson($tasks);
                break;
            }
        }
    }

    function deleteMultipleTask($arr){
        $tasks=getTasks();
        foreach($arr as $id){
            foreach($tasks as $key=>$task){
                if($task['id']==$id)
                    array_splice($tasks,$key,1);
            }
        }
        print_r($tasks);
        addIntoJson($tasks);
    } 

    function editTaskStatus($id){
        $tasks=getTasks();
        foreach($tasks as $key=>$task){
            if($task['id']==$id){
                $tasks[$key]['checked']?$tasks[$key]['checked']=false:$tasks[$key]['checked']=true;
            }
        }
        addIntoJson($tasks);
    }

    function addIntoJson($arr){
        file_put_contents("task.json",json_encode($arr,JSON_PRETTY_PRINT));
    }

    //if user check a task
    if(isset($_POST['checked_task_id'])){
        editTaskStatus($_POST['checked_task_id']);
    }
?>