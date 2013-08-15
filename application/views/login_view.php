<h1>Войти</h1>
<div id='body'>
    <form action = '<?= site_url($this->uri->uri_string);?>' method ='post'>
        <p>
            <label>Введите имя<label/>
            <input name ='login'>
        <p/>
        <p>
            <label>Введите пароль<label/>
            <input name ='password' type ='password'>
        <p/>
        <p><button name='submit' type='submit' id='submit' > Войти</button>
    </form>
    <div class="<?=$class_type;?>" > <?=$message;?></div>
<div/>