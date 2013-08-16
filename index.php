<?php

// Include the core application
require_once "app/app.php";

// Handle the request
echo $app->run(new \Bullet\Request());
