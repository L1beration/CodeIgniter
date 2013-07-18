<script type="text/javascript" src="/js/table.js"></script> 
<div id="body">
    <h1>Список студентов</h1>
    <table>
        <?php
            foreach ($students as $valueArray) {
                $i = 0;
                echo '<tr><td>';
                
                foreach ($valueArray as  $value) {
                    if($i == 0)
                        $id = $value;
                    else echo htmlspecialchars($value).'</td><td>';
                    if($i == 1)
                        $student_name = htmlspecialchars($value);
                    if($i == 2)
                        $class_id = htmlspecialchars($value);

                    $i++;
                }
                if($check_auth){
                    echo '<button type="button" onclick="updateElement('. $id .', \''. addslashes($student_name) .'\', \' '. addslashes($class_id) .'\');">Изменить </button>';
                    echo '<button type="button" onclick="return confirmDelete('. $id .');">Удалить </button>';
                }
                echo '</td></tr>';
            }
         ?>
    </table>
<div/>
<div class="<?=$class_type;?>" > <?=$message;?></div>