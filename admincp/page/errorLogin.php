<?php
$ErrorLogin = getAllTable('*', 'datalogin','WHERE countError = 1 ORDER BY `id` DESC LIMIT 10 ');
exit(require_once 'tmp/errorlogin.html');