<div id='body'>
    <h1>Изменить запись</h1>
    <form id ="updateForm" action ='' method ='post'>
        <p>
            <label>Введите новое имя</label>
            <input name ='student_new_name' id ='student_new_name' value = '<?=$student_name;?>' >
        <p/>
        <label>Выберите группу</label>
        <select name='new_class_id' size='1' id ='new_class_id' value = '<?=$class_id;?>' >
            <option value='1'>Группа 1</option>
            <option value='2'>Группа 2</option>
        </select>
        <p><button class="update" type="button" id="<?=$id;?>" student_name="<?=$student_name;?>" class_id="<?=$class_id;?>">Изменить</button></p>
    </form> 
    <div class="<?=$class_type;?>" > <?=$message;?></div>
</div>