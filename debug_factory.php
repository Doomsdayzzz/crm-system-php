<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$factory = new \Database\Factories\ApplicationFactory();

echo "definition() exists: " . (method_exists($factory, 'definition') ? 'yes' : 'no') . PHP_EOL;
echo "definition() result: ";
var_dump($factory->definition());

echo PHP_EOL . "States: ";
$reflection = new ReflectionClass($factory);
$prop = $reflection->getProperty('name');
$prop->setAccessible(true);
echo "Factory name: " . $prop->getValue($factory) . PHP_EOL;
