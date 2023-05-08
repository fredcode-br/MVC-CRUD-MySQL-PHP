<?php 

require_once 'app/Core/Core.php';

require_once 'lib/Database/Connection.php';

require_once 'app/Controller/HomeController.php';
require_once 'app/Controller/PostController.php';
require_once 'app/Controller/ErrorController.php';
require_once 'app/Controller/AboutController.php';
require_once 'app/Controller/AdminController.php';

require_once 'app/Model/Post.php';
require_once 'app/Model/Comentario.php';

require_once 'vendor/autoload.php';

$template = file_get_contents('app/Template/estrutura.html');
ob_start();
    $core = new Core;
    $core->start($_GET);

    $exit = ob_get_contents();
ob_end_clean();

$content = str_replace('{{area_dinamica}}', $exit, $template);

echo $content;

