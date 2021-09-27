
function getSelectedTask(){
    let checkboxs = [...document.getElementsByClassName("checkbox")];
    let checkedTask=[];
    checkboxs.map(elm=>{
        if(elm.checked)
            checkedTask.push(elm.id);
    });
    document.getElementById("multipl_id").value=checkedTask.toString();
    document.getElementById("finished").value=checkedTask.toString();
    document.getElementById("all").value=checkedTask.toString();
}
function handleCheckboxChange(e){
    try{
        ajaxOBJ=new XMLHttpRequest();
    }catch(e){
        alert('conection error');
    }
    ajaxOBJ.open("post",'task.php',true);
    ajaxOBJ.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded");
    ajaxOBJ.send("checked_task_id="+e.target.id);
    if(e.target.checked)
        e.target.className="checkbox checked";
    else
        e.target.className="checkbox";
}