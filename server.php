<?php


$host = 'localhost';
$port = '20205';

$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket");
$result = socket_bind($socket, $host, $port) or die("could not bind socket");

$result = socket_listen($socket, 3) or die("could not set up socket listener");
echo "Listening for connection \t";

class Chat
{
    function readline()
    {
        return rtrim(fgets(STDIN));
    }
}

do {
    $accept = socket_accept($socket) or die("could not accept incoming connection");
    $msg = socket_read($accept, 1024) or die("could not read input \n");

    $msg = trim($msg);
    echo "Client says:\t $msg \n\n";

    $line = new Chat();
    echo "Enter reply:\t";
    $reply = $line->readline();

    socket_write($accept, $reply, strlen($reply)) or die("Could not write output\n");
} while (true);

socket_close($accept, $socket);
