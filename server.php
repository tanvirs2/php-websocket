<?php


$host = 'localhost';
$port = '20205';

$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket");
$result = socket_bind($socket, $host, $port) or die("could not bind socket");

$result = socket_listen($socket, 3) or die("could not set up socket listener");
echo "Listening for connection \t";

?>


    <form method="post">
        <table>
            <tr>
                <td>
                    <label>
                        <input type="text" name="txt_msg">
                        <input type="submit" name="btn_send" value="Send">
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                <textarea name="" id="" cols="40" rows="10">
                    <?php echo $reply ?>
                </textarea>
                </td>
            </tr>

        </table>
    </form>

<?php

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
    echo "Client says: $msg \n\n";

    $line = new Chat();
    echo "Enter reply:";

    if (isset($_POST['btn_send'])) {
        $msg = $_REQUEST['txt_msg'];
        $sock = socket_create(AF_INET, SOCK_STREAM, 0);
        socket_connect($sock, $host, $port);

        socket_write($sock, $msg, strlen($msg));

        $reply = socket_read($sock, 1024);
        $reply = trim($reply);
        $reply = "CL2: $reply";

    }

    //$reply = $line->readline();

    socket_write($accept, $reply, strlen($reply)) or die("Could not write output\n");
} while (true);

socket_close($accept, $socket);
