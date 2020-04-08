<?php

namespace Commands;

use Symfony\Component\Console\Application;

$app = new Application();
$app->add(new UploadFileCommand());
$app->run();