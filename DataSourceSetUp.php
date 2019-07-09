<?php

require_once 'src/entities/Factory.php';

$config = parse_ini_file('src/config/db.ini');
$storage = Factory::getDataSource($config['dataSource']);
$storage->connect();
