<div class="errbox">
    <?php
    if(!empty($errors)){
        echo 'Error(s): ';
        foreach ($errors as $error){echo '<span>'.$error.'</span>';
        }}
    ?>
</div>