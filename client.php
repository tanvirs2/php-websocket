<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
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

        <?php
        $host = "localhost";
        $port = 20205;

        $reply = '';

        if (isset($_POST['btn_send'])) {
            $msg = $_REQUEST['txt_msg'];
            $sock = socket_create(AF_INET, SOCK_STREAM, 0);
            socket_connect($sock, $host, $port);

            socket_write($sock, $msg, strlen($msg));

            $reply = socket_read($sock, 1024);
            $reply = trim($reply);
            $reply = "Server says: $reply";

        }
        ?>

        <tr>
            <td>
                <textarea name="" id="" cols="30" rows="10">
                    <?php echo $reply ?>
                </textarea>
            </td>
        </tr>

    </table>
</form>
</body>
</html>
