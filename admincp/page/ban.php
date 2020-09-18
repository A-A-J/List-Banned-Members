<?php get_headerMenu(); ?>
<aside class="menu-center-data text-right mr-3 ml-3 mt-3">
    <?php
        if ( $getPage == $menupageurl or $getPage == null ) {
            if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

                if (!empty($_POST['submit'])){
                    $Delete_id   =   filter_var($_POST['submit'], FILTER_SANITIZE_STRING );
                    $getMembersDelete = $con->prepare( "SELECT * FROM  $menupageurl WHERE id = '$Delete_id' " );
                    $getMembersDelete->execute();
                    $getMemberDelete = $getMembersDelete->fetch();
                    $cont = $getMembersDelete->rowCount();
                    $ErrorDeleteMsgStatus = array();
                    if ($cont == 0 ) {
                        $ErrorDeleteMsgStatus[] = Lang['Sorry_ban_delete_not'];
                    }else{
                        
                        $stmt = $con->prepare( "DELETE FROM $menupageurl WHERE `id`= ? " );
                        $stmt->execute( array( $Delete_id ) );
                        echo '<div class="mb-3 mt-1"><div class="msg success">' . Lang['Player_ban_removed'] . $getMemberDelete['name'].'</div></div>';
                    }    
                }

                if(!empty($_POST['submit_searh'])) {
                    
                    $search_text = filter_var($_POST['search_text'], FILTER_SANITIZE_STRING );
                    
                    $ErrorDeleteMsgStatus = array();
                    
                    if ( $search_text == null ){
                        $ErrorDeleteMsgStatus[] = Lang['E_Search_player_name'];
                    }

                    if(empty($ErrorDeleteMsgStatus)){
                        $chekTable= checkTable('name', 'ban', $search_text);
                        $rows = getAllTableFetch( '*', 'ban', 'WHERE name= "'.$search_text.'" ');
                        if ($chekTable == 1){ ?>

                            <div class="A-table">
                                <div class="table-responsive">
                                    <div class="w-100 p-2" style="background: #383838; color:#fff;"><?php echo Lang['Search_results_for'] . $rows['name'] ?></div>
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td><?php echo $rows['id'] ?></td>
                                                <td><?php echo $rows['name'] ?></td>
                                                <td><?php echo $rows['side'] ?></td>
                                                <td><?php echo $rows['reason_ban'] ?></td>
                                                <td>
                                                    <a href="<?php echo $rows['evidence'] ?>"
                                                        onclick="window.open(this.href,'targetWindow', `toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=SomeSize, height=SomeSize`); return false;"
                                                        class="fa fa-eye"> </a>
                                                </td>
                                                <td><?php echo $rows['by'] ?></td>
                                                <td><?php echo nicetime($rows['data']) ?></td>
                                                <td>
                                                    <a href="index.php?page=<?php echo $menupageurl;?>&getpage=edit&id=<?php echo $rows['id'];?>"
                                                        class="fa fa-edit"></a>
                                                    <a href="#" class="fa fa-ban" data-toggle="modal"
                                                        data-target=".bd-example-modal-sm-<?php echo $rows['id'];?>" title="<?php echo Lang['Delete_page'];?>"></a>
                                                </td>
                                            </tr>

                                            <div class="modal fade bd-example-modal-sm-<?php echo $rows['id'];?>" tabindex="-1"
                                                role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content A-msgwindows">
                                                        <form action="?page=<?php echo $menupageurl?>&page_home=1" method="post">
                                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo Lang['A_y_s_delete_members'];?>
                                                                <?php echo $rows['name']?> ؟</h5>
                                                            <button type="button" data-dismiss="modal" class="B-wave btn btn-updata"><?php echo Lang['Cancellation_Delete'];?></button>
                                                            <button type="submit" name="submit" class="B-wave btn btn-updata"
                                                                value="<?php echo $rows['id'];?>"><?php echo Lang['Delete'];?></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> 
                                        </tbody>
                                    </table>
                                </div>
                            </div><br><br>
                        <?php
                        }else{
                            $ErrorDeleteMsgStatus[] = Lang['Memberships'] .' '. $search_text.Lang['Not_found_records'];
                        }
                    }
                    
                }
            }

            $pagination_ban = new pagination();
            $pagination_ban->get_page_id('id', 'ban');
            $pagination_page = ($pagination_ban->get_pay_numper() > 1 ) ? ($pagination_ban->get_pay_numper() * $pagination_ban->get_page_limit() ) - $pagination_ban->get_page_limit(): 0 ;
            $pagination_ban_limit =  $pagination_ban->get_page_limit();
            $pagination_ban_number =  $pagination_ban->get_pay_numper();

            $getBanShow = $con->prepare("SELECT * FROM ban limit $pagination_page, $pagination_ban_limit");
            $getBanShow->execute();
            $getBanShowSelect = $getBanShow->fetchAll();
            $count = $getBanShow->rowCount();

            
            if($count == 0){
                echo '<a href="index.php?page='.$menupageurl.'&getpage=add" class="B-wave btn btn-updata">'.Lang['New_ban_members'].'</a>';
                echo  '<div class="msg p-2">'.Lang['Not_search_empity_ban'].'</div>';
                return true; 
            }
            
            
            if(!empty($ErrorDeleteMsgStatus)){
                foreach ( $ErrorDeleteMsgStatus as $msgDelete ) :
                    echo '<div class="mb-3 mt-1"><div class="msg error">'. $msgDelete.'!<br></div></div>';
                endforeach;
            } 
            
        

            include_once($urlpagetemp.'ban/banhome'.$ft);
        }elseif ( $getPage == 'add' ) {
            if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

                $new_name           = filter_var($_POST['new_name'], FILTER_SANITIZE_STRING );
                $new_side           = filter_var($_POST['new_side'], FILTER_SANITIZE_STRING );
                $new_reason_ban     = filter_var($_POST['new_reason_ban'], FILTER_SANITIZE_STRING );
                $new_evidence       = filter_var($_POST['new_evidence'], FILTER_SANITIZE_STRING );
                $new_date           = filter_var($_POST['new_date'], FILTER_SANITIZE_STRING );

                $ErrorMsg = array();

                if ( isset( $new_name ) ) {
                    if ( strlen($new_name) == null ){
                        $ErrorMsg[] = Lang['Not_name_ban'];
                    }
                }

                if ( isset( $new_side ) ) {
                
                    if ( strlen($new_side) == null ){
                        $ErrorMsg[] = Lang['must_add_party_been_b'];
                    }
                }

                if ( isset( $new_reason_ban ) ) {
                    if ( strlen($new_reason_ban) == null ){
                        $ErrorMsg[] = Lang['must_reason_ban'];
                    }
                }
                
                if ( isset( $new_evidence ) ) {
                    if ( strlen($new_evidence) == null ){
                        $ErrorMsg[] = Lang['must_guide_ban'];
                    }
                }    

                if ( $new_date == null ){
                    $new_date = date("d-m-Y h:i:s");
                } 

                if(!empty($ErrorMsg)){
                    echo '<div class="mb-3 mt-1"><div class="msg error">';
                    foreach ( $ErrorMsg as $msgDelete ) :
                        echo '['.$i_page++.'] - '.$msgDelete.'!<br>';
                    endforeach;
                    echo '</div></div>';
                } 


                if ( empty( $ErrorMsg ) ) {
                    $stmt = $con->prepare( 'INSERT INTO `ban`(`name`, `side`, `reason_ban`, `evidence`, `by`, `data`) VALUES (?,?,?,?,?,?)' );
                    $stmt->execute( array( $new_name, $new_side, $new_reason_ban, $new_evidence, $getUserNameAdmin['username'] , $new_date ) );
                    echo '<div class="mb-3 mt-1"><div class="msg success">'.Lang['Membership_ban'].' '.$new_name.'</div></div>';
                }



            }

            include_once($urlpagetemp.'ban/banadd'.$ft);
        }elseif ( $getPage == 'edit' ) {
            if ( $id_Chek == 0 ) {
                header( 'Location: ?page='.$menupageurl.'' );
            }

            $getPages = $con->prepare( "SELECT * FROM  $menupageurl WHERE id = $id_Chek " );
            $getPages->execute();
            $getPage = $getPages->fetch();
            $cont = $getPages->rowCount();
            if ( $cont == 0 ) {
                echo '<div class="msg error p-2 pr-3">'.Lang['Membership_No'] .' '. $id_Chek . Lang['Not_found_records'].'</div>';
                echo '<a href="?page='.$menupageurl.'" class="B-wave btn btn-updata mt-3">'.Lang['Return'].'..</a>';
            }else{

                if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

                    $edit_name           = filter_var($_POST['edit_name'], FILTER_SANITIZE_STRING );
                    $edit_side           = filter_var($_POST['edit_side'], FILTER_SANITIZE_STRING );
                    $edit_reason_ban     = filter_var($_POST['edit_reason_ban'], FILTER_SANITIZE_STRING );
                    $edit_evidence       = filter_var($_POST['edit_evidence'], FILTER_SANITIZE_STRING );
                    $edit_date           = filter_var($_POST['edit_date'], FILTER_SANITIZE_STRING );

                    $ErrorMsg = array();
                    if ( isset( $edit_name ) ) {
                        if ( strlen($edit_name) == null ){
                            $ErrorMsg[] = Lang['Not_name_ban'];
                        }
                    }

                    if ( isset( $edit_side ) ) {
                    
                        if ( strlen($edit_side) == null ){
                            $ErrorMsg[] = Lang['must_add_party_been_b'];
                        }
                    }

                    if ( isset( $edit_reason_ban ) ) {
                        if ( strlen($edit_reason_ban) == null ){
                            $ErrorMsg[] = Lang['must_reason_ban'];
                        }
                    }

                    if ( isset( $edit_evidence ) ) {
                        if ( strlen($edit_evidence) == null ){
                            $ErrorMsg[] = Lang['must_guide_ban'];
                        }
                    }

                    if ( $edit_date == null ){
                        $edit_date = date("d-m-Y h:i:s");
                    } 

                    if(!empty($ErrorMsg)){
                        echo '<div class="mb-3 mt-1"><div class="msg error">';
                        foreach ( $ErrorMsg as $msgDelete ) :
                            echo '['.$i_page++.'] - '.$msgDelete.'!<br>';
                        endforeach;
                        echo '</div></div>';
                    } 
                    
                    if ( empty( $ErrorMsg ) ) {
                        $stmt = $con->prepare('UPDATE `ban` SET `name`=?,`side`=?,`reason_ban`=?,`evidence`=?,`by`=?,`data`=? WHERE `id` = ?');
                        $stmt->execute( array( $edit_name, $edit_side, $edit_reason_ban, $edit_evidence, $getPage['by'], $edit_date, $id_Chek ) );
                        echo '<div class="mb-3 mt-1"><div class="msg success">'.Lang['success_updated_ms'].' '.$edit_name.'</div></div>';
                    }
                }
                include_once($urlpagetemp.'ban/banedit'.$ft);
            }
        }
    ?>
</aside>