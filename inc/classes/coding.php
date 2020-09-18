<?php class coding {
    public function run() {
        global $con;
        $getAll=$con->prepare("SELECT * FROM sett");
        $getAll ->execute();
        $row=$getAll->fetch();

        if($row['copyright']==0) {
            $get=base64_decode('PHNwYW4gc3R5bGU9ImNvbG9yOiAjZmZmOyBmb250LWZhbWlseTogdGFob21hOyBkaXJlY3Rpb246IGx0ciAhaW1wb3J0YW50OyBmb250LXNpemU6IDEycHg7IHRleHQtc2hhZG93OiAycHggM3B4IDRweCAjMDAxZWZmOyBwb3NpdGlvbjogYWJzb2x1dGU7IGJvdHRvbTogNnB4OyI+RGVzaWduZWQgYW5kIGNvZGVkIGJ5IDxhIGhyZWY9Imh0dHBzOi8vZ2l0aHViLmNvbS9BYi0wIj5CYXNobzwvYT48L3NwYW4+');
        }

        else {
            $get=null;
        }

        return $get;
    }
}