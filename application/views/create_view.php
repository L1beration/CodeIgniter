<h1>Добавить запись</h1>
<div id='body'>
    <form action ='/index.php/student_controller/create/' method ='post'>
        <p>
            <label>Введите имя<label/>
            <input name ='student_name'>
        <p/>
        <label>Выберите группу<label/>
        <select name='class_id' size='1'>
            <option value='1'>Группа 1</option>
            <option value='2'>Группа 2</option>
        </select>
        <p><button name='submit' type='submit' id='submit' >Добавить</button>
    </form>
  <div class="<?=$class_type;?>" > <?=$message;?><div/>
<div/>