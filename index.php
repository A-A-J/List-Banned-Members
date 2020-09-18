<?php require 'inc/SETTING.php';?>
<html dir="<?php echo Lang['Dir']; ?>" lang="ar">
<head>
    <title><?php echo $getDataInfoScript['nWebsit'];?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="<?php echo $getDataInfoScript['kWebsit'];?>">
    <meta name="description" content="<?php echo $getDataInfoScript['dWebsit'];?>">

    <link rel="shortcut icon" href="img/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="76x76" href="img/favicon/favicon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="mask-icon" href="img/favicon/favicon.png">

    <link rel="stylesheet" href="look/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="look/font-awesome/font-awesome.css">
    <link rel="stylesheet" href="look/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="look/fonts/fonts.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <aside class="d-flex flex-column align-items-center justify-content-center" style="height: 100vh; padding: 1.875rem;">

        <menu>
            <a class="settingStyle fa fa-language" title="<?php echo Lang['Choose_language'];?>" data-toggle="modal" data-target="#exampleModalCenter"></a>
        </menu>

        
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle"><?php echo Lang['Language_options'];?></h5>
                    </div>
                    
                    <!--Start Lang Class-->
                    <?php $get_Languages  = new LANGUAGES(); $get_Languages->get_language_select();  ?>
                    <!--End Lang Class-->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo Lang['Hide'];?></button>
                    </div>

                </div>
            </div>
        </div>

        <div id="main-body" class="overflow-auto">
            <h2 class="font-color-title"><?php echo Lang['List_banned'];?></h2>

            <?php if($getDataInfoScript['sWebsit'] == 0){?>
            
            <input type="text" id="name_search" class="mb-3" name="name_search" placeholder="<?php echo Lang['msg_input_search_ban'];?>"/>

            <!--Start - SearchTopTaypBan or GetTopTaypBan-->
            <div class="top_ban"></div>
            <!--End - SearchTopTaypBan or GetTopTaypBan-->

            <?php }else{ echo '<div class="msg" style="background: #000; border: unset; color: #bfbfbf; font-weight: bold;">'.$getDataInfoScript['sText'].'</div>'; }?>

        </div>


        <?php echo Get__;?>


    </aside>

    <script type="text/javascript" src="look/jquery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="look/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="look/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="look/jquery/main.js"></script>
</body>
</html>
