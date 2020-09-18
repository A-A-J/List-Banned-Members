<?php

if(!empty($_POST['select_lang_1'])){
    setcookie("select_lang_index" , 1 , time() + 60*60*24*7); header( 'Location: index.php' );
}elseif(!empty($_POST['select_lang_2'])){
    setcookie("select_lang_index" , 2 , time() + 60*60*24*7); header( 'Location: index.php' );
}

if( isset($_COOKIE['select_lang_index']) AND $_COOKIE['select_lang_index'] == 1){
    require 'lang/arabic.php';
}elseif(isset($_COOKIE['select_lang_index']) AND $_COOKIE['select_lang_index'] == 2){
    require 'lang/English.php';
}else{
    require 'lang/arabic.php';
}


class LANGUAGES {
    public function get_language_select(){
        ?>
        
        <form action="index.php" method="POST" class="modal-body m-0">
            <ul>
                <li><input type="submit" name="select_lang_1" value="<?php echo Lang['Arabic']?>"/></li>
                <li><input type="submit" name="select_lang_2" value="<?php echo Lang['Einglish']?>"/></li>
            </ul>
        </form>
        
        <?php
    }
}