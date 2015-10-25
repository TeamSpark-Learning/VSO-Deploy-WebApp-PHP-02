<?php

require __DIR__ . '/vendor/autoload.php';

$app = function ($request, $response) {
    $text = 'Hello world!!!';
    $headers = array('Content-Type' => 'text/plain');

    $response->writeHead(200, $headers);
    $response->end($text);
};

$loop = React\EventLoop\Factory::create();
$socket = new React\Socket\Server($loop);
$http = new React\Http\Server($socket);

$http->on('request', $app);

$port = $_SERVER['SERVER_PORT'];
if (empty($port)) {
	$port = 1337;
}

$socket->listen($port);
$loop->run();