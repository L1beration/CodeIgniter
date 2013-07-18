<div id='body'>
    <h1>Изменить запись</h1>
    <form action ='' method ='post'>
        <p>
            <label>Введите новое имя</label>
            <input name ='student_new_name' id ='student_new_name' value = '<?=$student_name;?>' >
        <p/>
        <label>Выберите группу</label>
        <select name='class_id' size='1' id ='class_id' value = '<?=$class_id;?>' >
            <option value='1'>Группа 1</option>
            <option value='2'>Группа 2</option>
        </select>
        <p><input type='button' id='submit' value='Изменить' onclick ='updateElement(<?=$id?>, "<?=$student_name;?>", "<?=$class_id;?>");' />
    </form> 
    <div class="<?=$class_type;?>" > <?=$message;?></div>
</div>