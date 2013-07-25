<h1>Добавить запись</h1>
<div id='body'>
    <form id ="createForm" action ='' method ='post'>
        <p>
            <label>Введите имя<label/>
            <input name ='student_name'>
        <p/>
        <label>Выберите группу<label/>
        <select name='class_id' size='1'>
            <option value='1'>Группа 1</option>
            <option value='2'>Группа 2</option>
        </select>
        <p><button class="create" type="button" >Добавить</button></p>
    </form>
  <div class="<?=$class_type;?>" > <?=$message;?><div/>
<div/>