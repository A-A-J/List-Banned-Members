<?php
    require 'inc/connection.php';
    
    $getPage = isset( $_GET['page'] ) ? $_GET['page'] : ''; 

    $MsgError = '<b>عملية التثبيت فشلت من فضلك أعد محاولة التثبيت أو أستخدم ورقة Script_Sql.sql ستجدها داخل مجلد التثبيت instal وبعد عملية التثبيت قم بحذف مجلد التثبيت وورقة instal.php.</b>';
 
    if ( $getPage == 'step' ){
        $nm = 1;
    }elseif ( $getPage == 'step2' ){
        $nm = 2;
    }elseif ( $getPage == 'step3' ){
        $nm = 3;
    }elseif ( $getPage == 'step4' ){
        $nm = 4;
    }elseif ( $getPage == 'step5' ){
        $nm = 5;
    }

?>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تثبيت البرنامج</title>
    <link rel="stylesheet" href="look/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="look/font-awesome/font-awesome.css">
    <link rel="stylesheet" href="look/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="look/fonts/fonts.css">
    
    <style>
        body {
            font-family: "Droid Arabic Kufi", "tahoma", sans-serif;
            background: #eee;
            height: 100vh;
            padding: 1.875rem
        }

        main {
            max-height: 42.5rem;
            height: 70%;
            position: relative;
            width: 100%;
            text-align: -webkit-center;
        }

        .menu {
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            padding: 5px;
        }

        .content {
            background-color: #fff;
            border-left: 1px solid #ddd;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            width: 85%;
            padding: 1rem;
            position: relative;
        }

        .menu>ul {
            list-style: none;
            padding: 1rem;
            margin: 0;
        }

        .menu>ul>li {
            background: #0000000f;
            border: 1px solid #ddd;
            margin: 15px 0;
            padding: 5px;
            font-size: 12px;
            border-radius: 10px;
            cursor: pointer;
        }

        .content>h2 {
            font-size: 20px;
            font-weight: bold;
            color: #3e9efd;
        }

        .content>b {
            font-size: 13px;
            display: block;
            text-align: justify;
            font-weight: normal;
            line-height: 1.5rem;
        }

        .content>b>a {
            font-weight: bold;
        }

        .content>a {
            background: #f55f5f;
            color: #fff;
            padding: 5px;
            font-size: 11px;
            border-radius: 5px;
            text-decoration: none;
            position: absolute;
            left: 4rem;
            bottom: 15px;
        }

        .content>form>input {
            background: #5f88f5;
            color: #fff;
            padding: 5px;
            font-size: 11px;
            border-radius: 5px;
            text-decoration: none;
            position: absolute;
            left: 20px;
            bottom: 15px;
            border: unset;
        }

        .content>ul {
            text-align: right;
        }

        .content>ul>h2 {
            font-size: 12px;
            font-weight: bold;
        }

        .content>ul>li {
            margin: 8px 0;
            font-size: 12px;
        }

        .msg {
            line-height: normal;
            background: #b7b7b7;
            color: #fff;
            padding: 2px 10px;
            border-radius: 5px;
            font-size: 11px !important;
            font-weight: bold;
        }

        .error {
            background: red;
        }

        .success {
            background: #27b127;
        }

        form {
            margin: 0;
        }

        form>.form-group {
            margin: 0;
            padding: 0;
        }

        form>.form-group>label {
            margin: 0px 0px 5px;
            font-size: 13px;
            text-align: right;
            display: block;
        }

        form>.form-group>.form-control {
            font-size: 11px;
            margin-bottom: 13px;
            background: #f9f9f9;
        }

        .input-all {
            display: flex;
            list-style: none;
            padding: 0;
            text-align: center !important;
            margin-top: 2rem;
        }

        .input-all>li {
            -webkit-flex: auto;
            -moz-flex: auto;
            -ms-flex: auto;
            flex: auto;
        }

        .input-all>li>a {
            font-size: 11px;
            background: #f2f2f2;
            border: 1px solid #0002;
            padding: 2rem 0;
            margin: 5px !important;
            border-radius: 1rem;
            display: block;
            text-decoration: none;
            color: unset;
            -ms-transition: .3s all;
            -webkit-transition: .3s all;
            -o-transition: .3s all;
            transition: .3s all;
        }

        .input-all>li>a:hover {
            background: #3e9efd;
            border: 1px solid #0000001c;
            color:#fff;
        }
        .menu>ul>li:nth-child(<?php echo $nm;?>){
            background: #3e9efd;
            color: #fff;
        }
    </style>
</head>

<body class="d-flex flex-column align-items-center justify-content-center m-0">

    <main class="overflow-hidden d-table-row w-75">

        <div class="d-table-cell align-top menu">
            <ul>
                <li class="active">مرحبًا بك</li>
                <li>تثبيت الجداول</li>
                <li>إعدادات البرنامج</li>
                <li>إعدادات العضوية</li>
                <li>النهاية</li>
            </ul>
        </div>

        <div class="d-table-cell align-top content">

            <h2>Script Ban Members</h2>

            <?php
            if ( $getPage == 'step' ){
                echo '
                    <b>مرحبا.. بالبداية أشكرك على إستخدامك لأحد برمجياتي التي قمت ببرمجتها من الصفر وعلمًا بأنه يمكنك أن تشاهد جميع أعمالي من خلال صفحتي في منصة <a href="https://github.com/Ab-0">Guthub</a>. وبخصوص إتفاقية الإستخدام أنا أسمح للجميع بإستخدام برمجيتي بالكامل ولكن؛ لن أسمح لمن يدعي بأنها من تطويره او أيًا كانت، وفي النهاية أسأل الله العلي العظيم بأن يوفقك في إدارة هذا المشروع الجميل، تحياتي لك.</b>
                    <form action="install.php?page=step2" method="POST">
                        <input type="submit" name="step2" value="التالي">    
                    </form>
                ';

            }elseif ( $getPage == 'step2' AND isset($_POST['step2']) ){
                
                    $array  = array('Members','datalogin','sett','ban');
                
                    try {

                        $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

                        $sql_updata_table ="
                            CREATE TABLE `ban` (
                                `id` int(11) NOT NULL,
                                `name` varchar(255) NOT NULL,
                                `side` text NOT NULL,
                                `reason_ban` text NOT NULL,
                                `evidence` text NOT NULL,
                                `by` text NOT NULL,
                                `data` text NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
                            
                            
                            CREATE TABLE `datalogin` (
                                `id` int(11) NOT NULL,
                                `username` varchar(255) NOT NULL,
                                `countError` int(2) NOT NULL DEFAULT 0,
                                `dateLogin` varchar(255) NOT NULL,
                                `country` varchar(255) NOT NULL,
                                `ip` varchar(255) NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
                            
                            
                            CREATE TABLE `members` (
                                `id` int(11) NOT NULL,
                                `username` varchar(255) NOT NULL,
                                `password` varchar(255) NOT NULL,
                                `avatar` text NOT NULL,
                                `email` varchar(255) NOT NULL,
                                `group` int(11) NOT NULL DEFAULT 1,
                                `data` varchar(255) NOT NULL,
                                `updata_date` varchar(255) NOT NULL,
                                `ip` text NOT NULL,
                                `Basis` int(11) NOT NULL DEFAULT 0
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
                            
                            
                            CREATE TABLE `sett` (
                                `id` int(11) NOT NULL,
                                `nWebsit` varchar(50) NOT NULL,
                                `dWebsit` varchar(255) NOT NULL,
                                `kWebsit` varchar(255) NOT NULL,
                                `sWebsit` int(1) NOT NULL DEFAULT 0,
                                `sText` text NOT NULL,
                                `ipWebsit` varchar(255) NOT NULL,
                                `urlWebsit` text NOT NULL,
                                `copyright` int(11) DEFAULT 0,
                                `note` text NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
                            
                            
                            ALTER TABLE `ban`
                                ADD PRIMARY KEY (`id`);
                            
                            
                            ALTER TABLE `datalogin`
                                ADD PRIMARY KEY (`id`);
                            
                            
                            ALTER TABLE `members`
                                ADD PRIMARY KEY (`id`);
                            
                            
                            ALTER TABLE `sett`
                                ADD PRIMARY KEY (`id`);
                            
                            
                            ALTER TABLE `ban`
                                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
                            
                            
                            ALTER TABLE `datalogin`
                                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
                            
                            ALTER TABLE `members`
                                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
                            
                            
                            ALTER TABLE `sett`
                                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
                            COMMIT;
                        ";

                        $con->exec($sql_updata_table);

                        echo '<ul class="list-inline p-0 m-0">';
                        echo '<h2>تم تثبيت الجداول التالية:</h2>';

                        foreach($array as $array){
                            echo '<li>- '.$array.'</li>';
                        }

                        echo '</ul>';

                        echo '
                            <form action="install.php?page=step3" method="POST">
                                <input type="submit" name="step3" value="التالي">    
                            </form>
                        ';

                    } catch (PDOException $e) {

                        $errormsg = array();

                        if ($e->getCode() == '42S01') {

                            $table_exists = str_word_count($e->getTrace()[0]['args'][0],1);
                            $errormsg [] = 'لا يمكن إضافة قاعدة البيانات '.$table_exists[2].' نظرًا إلى وجودها في القاعدة';

                        }else {

                            $errormsg [] = $e->getMessage();

                        }

                        $i = 1;

                        echo '<ul class="list-inline p-0 m-0">';
                        foreach($errormsg as $error){
                            $count = $i++;
                            echo '<div class="msg error">['.$count.'] - '.$error.'!<br></div>';
                        }
                        echo '</ul>';

                    }
                
            }elseif ( $getPage == 'step3' AND isset($_POST['step3']) ){

                echo '
                    <form action="install.php?page=step4" method="POST">

                        <div class="form-group">
                            <label>اسم الموقع:</label>
                            <input type="text" class="form-control form-control-sm" aria-describedby="emailHelp" placeholder="أنقر هنا لكتابة أسم الموقع.." name="nWebsit" value="قائمة المحظورين في '.$_SERVER['SERVER_NAME'].'">
                        </div>

                        <div class="form-group">
                            <label>وصف الموقع</label>
                            <input type="text" class="form-control form-control-sm" placeholder="أنقر هنا لكتابة وصف الموقع..." name="dWebsit" value="هنا ستجد جميع أسماء المحظورين في لعبة '.$_SERVER['SERVER_NAME'].' الخاصة.">
                        </div>

                        <div class="form-group">
                            <label>مفتاح الموقع</label>
                            <input type="text" class="form-control form-control-sm" placeholder="أدخل هنا الكلمات الدلالية للموقع على سبيل المثال: حظر، الأعضاء، اللعبة" name="kWebsit" value="لعبة، '.$_SERVER['SERVER_NAME'].'، للابطال، محظورين، حظر، مخالف، مخالفة">
                        </div>
                        
                        <input type="submit" name="step4" value="التالي">    

                    </form>
                ';

            }elseif ( $getPage == 'step4' AND isset($_POST['step4']) ){

                $getSett = $con->prepare("INSERT INTO `sett`(
                    `id`,
                    `nWebsit`,
                    `dWebsit`,
                    `kWebsit`,
                    `sWebsit`,
                    `sText`,
                    `ipWebsit`,
                    `urlWebsit`,
                    `copyright`,
                    `note`
                )
                VALUES(
                    NULL,
                    ?,
                    ?,
                    ?,
                    '0',
                    '',
                    '',
                    '',
                    '0',
                    ''
                )");

                $getSett->execute(array($_POST['nWebsit'],$_POST['dWebsit'],$_POST['kWebsit']));

                echo '
                
                <form action="install.php?page=step5" method="POST">

                <div class="form-group">
                    <label>أسم العضوية</label>
                    <input type="text" class="form-control form-control-sm" aria-describedby="emailHelp" placeholder="أنقر هنا لكتابة أسم عضوية مدير الموقع.." name="UserNameAdmin" value="Admin">
                </div>

                <div class="form-group">
                    <label>كلمة المرور</label>
                    <input type="password" class="form-control form-control-sm" placeholder="********" name="password" value="Admin">
                </div>

                <div class="form-group">
                    <label>البريد الإلكتروني</label>
                    <input type="email" class="form-control form-control-sm" placeholder="على سبيل المثال: admin@gmail.com" name="email" value="admin@gmail.com">
                </div>
                
                <input type="submit" name="step5" value="التالي">    

            </form>
                
                ';
                

            }elseif ( $getPage == 'step5' AND isset($_POST['step5']) ){

                try {

                    $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

                    $getMemberAdmin = $con->prepare(" INSERT INTO `members`( `id`, `username`, `password`, `avatar`, `email`, `group`, `data`, `updata_date`, `ip`, `Basis` ) VALUES( NULL, ?, ?, '', ?, '1', '', '', '', '1' ) ");

                    $getMemberAdmin->execute(array($_POST['UserNameAdmin'],sha1($_POST['password']),$_POST['email']));

                    unlink('install.php');
                    
                    echo '
                        <div class="msg success">تم إنشاء العضوية وحذف ورقة Install.php بنجاح، والأن ماذا تريد أن تفعل؟</div>
                        <ul class="input-all">
                            <li><a href="admincp/index.php?page=ban&getpage=add">حظر عضوية</a></li>

                            <li><a href="admincp/index.php?page=members&getpage=add">إنشاء عضوية</a></li>

                            <li><a href="index.php">الرئيسية</a></li>

                            <li><a href="admincp/index.php">لوحة التحكم</a></li>
                        </ul>
                    ';

                } catch (PDOException $e) {

                    echo '<div class="msg error">'.$e->getMessage().'<br></div>';

                }

            }elseif ((!isset($getPage)) || ($getPage != "step" && $getPage != "step2" && $getPage != "step3" && $getPage != "step4" && $getPage != "step5")){

                header( 'Location: ?page=step' );

            }else{

                echo $MsgError;

            }
            ?>
        </div>
    </main>
</body>
</html>