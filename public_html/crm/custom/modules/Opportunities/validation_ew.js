function check_custom_data()
{   nextdate=(document.getElementById("next_step_date_c").value).replace(/(\d+)\-(\d+)\-(\d+)/, '$2/$1/$3');

    now = new Date();
    curdate=new Date(now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate()).valueOf();
    if(Date.parse(nextdate)>=curdate){
        return check_form('EditView');
    }
    else{
        alert("Дата следующего шага не может быть меньше текущей даты");
        return false;
   }
}