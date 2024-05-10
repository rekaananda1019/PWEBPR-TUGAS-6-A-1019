<?php
// var_dump($_ENV);
$url = $_SERVER['REQUEST_URI'];
$dirName =  'ContactApp';
$url = implode("/",
                array_filter(
                    explode("/",
                        str_replace($dirName, "",
                            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
                        )
                    ),'strlen'
                )
            );
// var_dump($url);

switch ($url) {
    case 'login':
        include '/views/auth/login.php';
            break;
    case 'register':
        include '/views/auth/register.php';
                break;
    case 'dashboard':
        include '/views/dash/dashboard.php';
                break;

}