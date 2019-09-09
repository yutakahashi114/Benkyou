<?php

$test_servaddr = '192.168.3.7'; //server address
$test_servport = 10000; //port

$test_sock = stream_socket_client("tcp://$test_servaddr:$test_servport");
stream_set_blocking($test_sock, false);

$stdin = fopen('php://stdin', 'r');
stream_set_blocking($stdin, false);

while(true){
    $test_inputbuf = stream_get_contents($stdin);
    if ($test_inputbuf) {
        if (!($test_inputbuf = trim($test_inputbuf))) {
            continue;
        }
        $test_writebuf = $test_inputbuf . "\n";
        if (fwrite($test_sock, $test_writebuf, strlen($test_writebuf)) === false) {
            echo "socket_write()  error:".socket_strerror(socket_last_error());
        }

        //end of connection
        switch ($test_inputbuf) {

            case 'quit':
            fclose($test_sock);
            break 2;

            case 'shutdown':
            fclose($test_sock);
            break 2;

            default:
            break;
        }
    }

    $test_readbuf = fread($test_sock, 2048);
    if ($test_readbuf) {
        echo $test_readbuf;
    }
}
