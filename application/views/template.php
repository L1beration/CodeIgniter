<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='utf-8'>
        <title>Список студентов</title>
        <link type='text/css' rel='stylesheet' href ='/css/style.css' >
        <script type="text/javascript" src="/js/table.js"></script> 

    </head>
    <body>
        <div id ='main'>
            <ul id = 'menu'>
                <li><a href='/index.php/student_controller/index' >Просмотреть</a></li>
                <li><a href='/index.php/student_controller/create'>Добавить</a></li>
                <? if($check_auth)
                        echo '<li><a href= "/index.php/login_controller/logout">Выйти</a></li>';
                   else    
                        echo '<li><a href="/index.php/login_controller/login">Войти</a></li>';
                ?>

            </ul>
            <div id='container'>
                <?
                    $data['check_auth'] = $check_auth;
                    $this->load->view($content_view, $data); 
                ?>
            </div>


            <p class='footer'></p>
        </div>
    </body>
</html>