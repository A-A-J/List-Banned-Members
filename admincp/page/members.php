<?php get_headerMenu(); ?>
<aside class="menu-center-data text-right mr-3 ml-3 mt-3">
    <?php

    if ( $getPage == 'members' or $getPage == null ) {
       if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
            
            if (!empty($_POST['submit'])){
                $Delete_id   =   filter_var($_POST['submit'], FILTER_SANITIZE_STRING );
                $getMembersDelete = $con->prepare( "SELECT * FROM  members WHERE id = '$Delete_id' " );
                $getMembersDelete->execute();
                $getMemberDelete = $getMembersDelete->fetch();
                $cont = $getMembersDelete->rowCount();
                $ErrorDeleteMsgStatus = array();
                if ($cont == 0 ) {
                    $ErrorDeleteMsgStatus[] = 'عذر، العضوية التي تريد حذفها غير موجودة في سجلاتنا';
                }else{
                    if ($getMemberDelete['Basis'] == 1 ) {
                        $ErrorDeleteMsgStatus[] = '<div class="msg error">عذرًا هذه العضوية رئيسية ولا يمكنك حذفها';
                    }else{
                        $stmt = $con->prepare( 'DELETE FROM `members` WHERE `id`= ? ' );
                        $stmt->execute( array( $Delete_id ) );
                        echo '<div class="mb-3 mt-1"><div class="msg success">تم حذف العضوية '.$getMemberDelete['username'].' بنجاح </div></div>';
                    }
                }    
            }
            
        
        
            if(!empty($_POST['submit_searh'])) {
                
                $search_text =  filter_var($_POST['search_text'], FILTER_SANITIZE_STRING );
                
                $ErrorDeleteMsgStatus = array();
                
                if ( $search_text == null ){
                    $ErrorDeleteMsgStatus[] = 'لا يمكنك البحث وحقل رقم الصفحة فارغ';
                }

                if(empty($ErrorDeleteMsgStatus)){
                    $chekTable= checkTable('username', 'members', $search_text);
                    $rows = getAllTableFetch( '*', 'members', 'WHERE username= "'.$search_text.'" ');
                    if ($chekTable == 1){

                        echo '<div class="A-table">
                            <div class="table-responsive">
                                <div class="w-100 p-2" style="background: #383838; color:#fff;">نتائج البحث عن: '.$rows['username'].'</div>
                                <table class="table mb-0">
                                <tbody>';

                                    $i = $rows['id'];
                                    if($rows['group'] == 1 ){
                                        $name_group = '<b style="background: red;">الإدارة</b>';
                                    }else{
                                        $name_group = '<b style="background: orange;">مراقب</b>';
                                    }

                                    if($rows['avatar'] == null ){
                                        $avatar = '<h2 class="noimg">'.$rows['username'][0].'</h2>';
                                    }else{
                                        $avatar = '<img class="avatar_table" src="../img/avatar/'.$rows['avatar'].' "/>';
                                    }

                                    echo '<tr>
                                        <td class="p-2">'. $i .'</td>
                                        <td class="text-right">'. $avatar . ' ' . $rows['username'] .'</td>
                                        <td>'. $name_group .'</td>
                                        <td>'. nicetime($rows['data']) .'</td>
                                        <td>'. nicetime($rows['updata_date']) .'</td>
                                        <td>
                                            <a href="index.php?page='.$menupageurl.'&getpage=edit&id='.$rows['id'].'" class="fa fa-edit edit" data-toggle="tooltip" data-placement="right" title="تحرير الصفحة"></a> ';
                                            $delete = ' <a href="#" class="fa fa-ban delete" data-toggle="modal" data-target=".bd-example-modal-sm-'.$rows['id'].' " title="حذف الصفحة"></a>';
                                            getIfVa($rows['Basis'] == 1, ' ' , $delete);
                                        echo '</td>
                                    </tr>';
                                    echo '<div class="modal fade bd-example-modal-sm-'.$rows['id'].'" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content A-msgwindows">
                                                <form action="?page=members&page_home=1" method="post">
                                                    <h5 class="modal-title" id="exampleModalLabel">هل أنت متأكد من حذف العضوية  '.$rows['username'].'؟</h5>
                                                    <button type="button" data-dismiss="modal" class="B-wave btn btn-updata">إلغاء الحذف</button>
                                                    <button type="submit" name="submit" class="B-wave btn btn-updata" value="'.$rows['id'].'" >حذف</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                    </tbody>
                                </table>
                            </div>
                        </div><br><br>';
                    }else{
                        $ErrorDeleteMsgStatus[] = 'العضوية '.$search_text.' غير موجودة في سجلاتنا';
                    }
                }
                
            }

            if(!empty($ErrorDeleteMsgStatus)){
                foreach ( $ErrorDeleteMsgStatus as $msgDelete ) :
                    echo '<div class="mb-3 mt-1"><div class="msg error">'. $msgDelete.'!<br></div></div>';
                endforeach;
            } 
       }
        
        include_once($urlpagetemp.'members/membersHome'.$ft);
        
    }elseif ($getPage == 'add'){
        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
            $new_username   =   $_POST['new_username'];
            $new_password   =   $_POST['new_password'];
            $new_email      =   filter_var( $_POST['new_email'], FILTER_SANITIZE_EMAIL );
            $new_group      =   $_POST['new_group'];

            $formErrors     = array();
            
            if ( isset( $new_username ) ) {
                if ( strlen( $new_username ) == '' ) {
                    $formErrors[] =  'لا يمكنك ترك اسم المستخدم فارغًا';
                }elseif ( strlen( $new_username ) < 2 ) {
                    $formErrors[] =  'يجب أن يكون أسم المستخدم أكثر من حرف واحد';
                }elseif ( strlen( $new_username ) > 30 ) {
                    $formErrors[] =  'يجب أن يكون أسم المستخدم أقل من 30 حرف';
                }elseif (filter_var($new_username, FILTER_SANITIZE_STRING ) !=true){
                    $formErrors[] =  'لا يمكنك إضافة رموز أو أكواد داخل حقل أسم المستخدم';
                 }
            }
            if ( isset( $new_password ) ) {
                if ( strlen( $new_password ) == '' ) {
                    $formErrors[] =  'لا يمكنك ترك كلمة المرور فارغة';
                }elseif ( strlen( $new_password ) < 3 ) {
                    $formErrors[] =  'يجب أن تكون كلمة المرور أكثر من 3 أحرف او أرقام';
                }elseif ( strlen( $new_password ) > 30 ) {
                    $formErrors[] =  'يجب أن تكون كلمة المرور أقل من 30 حرف او رقم';
                }elseif (filter_var($new_password, FILTER_SANITIZE_STRING ) !=true){
                    $formErrors[] =  'لا يمكنك إضافة رموز أو أكواد داخل حقل أسم المستخدم';
                 }
            }
            if ( isset( $new_email ) ) {
				if (filter_var($new_email, FILTER_VALIDATE_EMAIL) != true) {
					$formErrors[] = 'البريد الإلكتروني غير صالح';
				 }elseif ( strlen( $new_email ) > 45 ) {
					$formErrors[] = 'يجب أن يكون البريد الإلكتروني أقل من 45 حرف';
				}elseif ( strlen( $new_email ) < 5 ) {
					$formErrors[] = 'يجب أن يكون البريد الإلكتروني أكثر من 5 أحرف';
				}
            }
            if ( isset( $new_group ) ) {
				if ( strlen( $new_group ) > 3 ) {
					$formErrors[] = 'يجب أن يكون الرقم أقل من 3 أرقام';
				}elseif ( strlen( $new_group ) < 0 ) {
					$formErrors[] = 'يجب أن يكون الرقم أكثر من رقم 0';
				}
            }
            $chekTable= checkTable('username', 'members', $new_username);
            $getTableSelectPagesHomes = getAllTableFetch( '*', 'members', 'WHERE username= "'.$new_username.'" ');
            if ($chekTable == 1){
                $formErrors[] = "أسم " . $new_username . " موجود سابقًا في سجلاتنا";
            }else{
                if ( empty( $formErrors ) ) {
                $stmt = $con->prepare( 'INSERT INTO `members`(`username`, `password`, `email`, `group`, `data`) VALUES (?,?,?,?,?)' );
                $stmt->execute( array( $new_username, sha1($new_password), $new_email, $new_group, date("d-m-Y h:i:s") ) );
                $msg_success_username = true;
                }
            }
        }
        include_once($urlpagetemp.'members/membersAdd'.$ft);


    }elseif ($getPage == 'edit'){
        if ( $id_Chek == 0 ) {
            header( 'Location: ?page=members' );
        }
        $getPages = $con->prepare( "SELECT * FROM  members WHERE id = '$id_Chek' " );
        $getPages->execute();
        $getPage = $getPages->fetch();
        $cont = $getPages->rowCount();
        if ( $cont == 0 ) {
            echo '<div class="msg error p-2 pr-3">أن العضوية رقم ' . $id_Chek . ' غير موجودة في سجلاتنا</div>';
            echo '<a href="?page=members" class="B-wave btn btn-updata mt-3">العودة..</a>';
        }else{
            if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
                $edit_username      =   $_POST['edit_username'];
                $edit_password      =   empty($_POST['edit_password']) ? $_POST['old_password'] : sha1($_POST['edit_password']);
                $edit_email         =   filter_var( $_POST['edit_email'], FILTER_SANITIZE_EMAIL );
                $edit_group         =   filter_var($_POST['edit_group'], FILTER_SANITIZE_STRING );
                $formErrors = array();
                if ( isset( $edit_username ) ) {
                    if ( strlen( $edit_username ) == '' ) {
                        $formErrors[] =  'لا يمكنك ترك اسم المستخدم فارغًا';
                    }elseif ( strlen( $edit_username ) < 2 ) {
                        $formErrors[] =  'يجب أن يكون أسم المستخدم أكثر من حرف واحد';
                    }elseif ( strlen( $edit_username ) > 30 ) {
                        $formErrors[] =  'يجب أن يكون أسم المستخدم أقل من 30 حرف';
                    }elseif (filter_var($edit_username, FILTER_SANITIZE_STRING ) !=true){
                        $formErrors[] =  'لا يمكنك إضافة رموز أو أكواد داخل حقل أسم المستخدم';
                    }
                }

                if ( isset( $edit_password ) ) {
                    if ( strlen( $edit_password ) == '' ) {
                        $formErrors[] =  'لا يمكنك ترك كلمة المرور فارغة';
                    }elseif (filter_var($edit_password, FILTER_SANITIZE_STRING ) !=true){
                        $formErrors[] =  'لا يمكنك إضافة رموز أو أكواد داخل حقل كلمة المرور';
                    }
                }

                if ( isset( $edit_email ) ) {
                    if (filter_var($edit_email, FILTER_VALIDATE_EMAIL) != true) {
                        $formErrors[] = 'البريد الإلكتروني غير صالح';
                     }elseif ( strlen( $edit_email ) > 45 ) {
                        $formErrors[] = 'يجب أن يكون البريد الإلكتروني أقل من 45 حرف';
                    }elseif ( strlen( $edit_email ) < 5 ) {
                        $formErrors[] = 'يجب أن يكون البريد الإلكتروني أكثر من 5 أحرف';
                    }
                }

                if ( isset( $edit_group ) ) {
                    if ( strlen( $edit_group ) > 3 ) {
                        $formErrors[] = 'يجب أن يكون الرقم أقل من 3 أرقام';
                    }elseif ( strlen( $edit_group ) < 0 ) {
                        $formErrors[] = 'يجب أن يكون الرقم أكثر من رقم 0';
                    }
                }
                if ($edit_username == $getPage['username'] ){
                    $chekTable= 2;
                }else{
                    $chekTable = checkTable('username', 'members', $edit_username);
                }
                $getTableSelectPagesHomes = getAllTableFetch( '*', 'members', 'WHERE username= "'.$edit_username.'" ');
                if ($chekTable == 1){
                    $formErrors[] = "أسم " . $edit_username . " موجود سابقًا في سجلاتنا";
                }else{
                    if ( empty( $formErrors ) ) {
                    $stmt = $con->prepare('UPDATE `members` SET `username`=?,`password`=?,`email`=?,`group`=?,`updata_date`=?,`ip`=? WHERE `id` = ?');
                    $stmt->execute( array( $edit_username, $edit_password, $edit_email, $edit_group, date("d-m-Y h:i:s"), $_SERVER['REMOTE_ADDR'], $id_Chek ) );
                    $msg_success_username = true;
                    }
                }
            }  
        }
        include_once($urlpagetemp.'members/membersEdit'.$ft);
    }else{
        header( 'Location: ?page=members' );
    }
    ?>
</aside>