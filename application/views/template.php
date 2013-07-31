<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='utf-8'>
        <title>Список студентов</title>
        <link type='text/css' rel='stylesheet' href ='/css/style.css' >
        <script type="text/javascript" src="/js/jquery.js"></script> 
        <script type="text/javascript" src="/js/table.js"></script> 
    </head>
    <body>
        <div id ='main'>
            <ul id = 'menu'>
                
                <?
                if($this->uri->segments[2] != 'index')
                    echo '<li><button onclick="location.href=\'/index.php/student_controller/index/\'">Просмотреть</button></li>';
                if($check_auth) {
                    echo '<li><button class="create" type="button" >Добавить </button></li>';
                    echo '<li><button onclick="location.href=\'/index.php/login_controller/logout\'">Выйти</button></li>';
                }
                else 
                    if($this->uri->segments[2] != 'login')
                        echo '<li><button onclick="location.href=\'/index.php/login_controller/login\'">Войти</button></li>';
                ?>

            </ul>
            <div id='container'>
                <?
                    $data['check_auth'] = $check_auth;
                    $this->load->view($content_view, $data); 
                ?>
            </div>
            <div id='add'></div>
            <p class='footer'></p>

        </div>

    </body>
</html>