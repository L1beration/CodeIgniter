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
                    echo '<button class="update" type="button" id="' .$id. '" student_name="' .addslashes($student_name). '" class_id="' .addslashes($class_id).'">Изменить </button>';
                    echo '<button class="delete" type="button" id="' .$id. '" >Удалить </button>';
                }
                echo '</td></tr>';
                
            }
         ?>
    </table>
    <?if(isset($uri)) $this->uri->segments[3] = $uri?>
    <?=$this->pagination->create_links();?>
</div>

<div id ="message" class="<?=$class_type;?>" > <?=$message;?></div>