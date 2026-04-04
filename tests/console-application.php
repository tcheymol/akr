<?php

use App\Kernel;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Dotenv\Dotenv;

require __DIR__.'/../vendor/autoload.php';

(new Dotenv())->bootEnv(__DIR__.'/../.env');

$appEnv = $_SERVER['APP_ENV'];
$kernel = new Kernel(\is_string($appEnv) ? $appEnv : 'dev', (bool) $_SERVER['APP_DEBUG']);

return new Application($kernel);
