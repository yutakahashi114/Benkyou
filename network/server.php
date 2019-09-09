<?php
error_reporting(E_ALL);

//Allow  the script to hang
set_time_limit(0);

//enables flush
ob_implicit_flush();

$address = '192.168.3.7'; //addr
$port = 10000; //port
$backlog = 5;
$bufsize = 2048;

//socket:create→bind→listen
if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false){
    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
}

if (socket_bind($sock, $address, $port) === false){
    echo "socket_bind() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n";
}

if (socket_listen($sock, $backlog) === false){
    echo "socket_listen() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n";
}

//nonblockmode
if(socket_set_nonblock($sock) === false){
    echo "socket_set_nonblock() failed: reason: ". socket_strerror(socket_last_error($sock)). "\n";
}

//clients list
// $clients = array($sock);

//for select
$read_sockets = array();
$write_sockets = NULL;
$error_sockets = NULL;
$select_interval = 0; //second
$client_ids = [0 => $sock];
// $client_ids = [
//     'id' => 'socket',
//     'id' => 'socket'
// ];
$client_list = [];
// $client_list = [
//     'id' => [
//         'name' => 'hoge',
//         'room' => 100
//     ],
//     'id' => [
//         'name' => 'huga',
//         'room' => 100
//     ]
// ];
$room_list = [];
// $room_list = [
//     'number' => ['id', 'id'],
//     'number' => ['id', 'id']
// ];
$id = 1;
// $id = 0;
while(true){
    $read_sockets = $client_ids;
    // $read_sockets = $clients;
    //read only
    $select = socket_select($read_sockets, $write_sockets, $error_sockets, $select_interval);
    //new client or new message
    if($select >= 1){
        //new client
        if(in_array($sock, $read_sockets)){
            //add client
            $newsock = socket_accept($sock);
            // $clients[] = $newsock;
            $client_list[$id] = [];
            $client_ids[$id] = $newsock;
            $id ++;
            $enter_name = "Enter your name : ";
            socket_write($newsock, $enter_name, strlen($enter_name));
            //delete new client from read list
            $client_id = array_search($sock, $read_sockets);
            unset($read_sockets[$client_id]);
        }
        //read message
        foreach($read_sockets as $read_key => $read_socket){
            //reaf failed
            if(($read_buf = socket_read($read_socket, $bufsize, PHP_NORMAL_READ)) === false){
                echo "socket_read() failed: reason: " . socket_strerror(socket_last_error($read_socket)) . "\n";
                //delete client
                $client_id = array_search($read_socket, $client_ids);
                unset($read_sockets[$read_key]);
                unset($client_ids[$client_id]);
                $room_id_key = array_search($client_id, $room_list[$client_list[$client_id]['room']]);
                unset($room_list[$client_list[$client_id]['room']][$room_id_key]);
                unset($client_list[$client_id]);
            }
            //invalied message
            else if (!$read_buf = trim($read_buf)){
                //delete client
                $client_id = array_search($read_socket, $client_ids);
                unset($read_sockets[$read_key]);
                unset($client_ids[$client_id]);
                $room_id_key = array_search($client_id, $room_list[$client_list[$client_id]['room']]);
                unset($room_list[$client_list[$client_id]['room']][$room_id_key]);
                unset($client_list[$client_id]);
                continue;
            }
            //end of connection
            if ($read_buf == 'quit'){
                $client_id = array_search($read_socket, $client_ids);
                unset($read_sockets[$read_key]);
                unset($client_ids[$client_id]);
                $room_id_key = array_search($client_id, $room_list[$client_list[$client_id]['room']]);
                unset($room_list[$client_list[$client_id]['room']][$room_id_key]);
                unset($client_list[$client_id]);
            }
            //shutdown server
            else if ($read_buf == 'shutdown'){
                //delete all client
                foreach($client_ids as $client){
                    if($sock != $client){
                        unset($client);
                    }
                }
                break 2;
            }
            //echo back
            else{
                $client_id = array_search($read_socket, $client_ids);
                // 名前がなければ名前をセット
                if (!isset($client_list[$client_id]['name'])) {
                    $client_list[$client_id]['name'] = $read_buf;
                    $enter_room = "Enter room number : ";
                    socket_write($read_socket, $enter_room, strlen($enter_room));
                // 部屋番号がなければ部屋番号をセット
                } else if (!isset($client_list[$client_id]['room'])) {
                    $client_list[$client_id]['room'] = $read_buf;
                    $room_list[$read_buf][] = $client_id;
                    $welcome = "Welcome to room " . $read_buf . "\n";
                    socket_write($read_socket, $welcome, strlen($welcome));
                // どちらもあればメッセージを書く
                } else {
                    echo "name : " . $client_list[$client_id]['name'] . ", ";
                    echo "room : " . $client_list[$client_id]['room'] . ", ";
                    echo "message : " . $read_buf . "\n";
                    $room_number = $client_list[$client_id]['room'];
                    //write message
                    $write_buf = $client_list[$client_id]['name'] . " : " . $read_buf . "\n";
                    // 同じ部屋にいる人にのみwriteする
                    foreach ($room_list[$room_number] as $room_member_id) {
                        $write_socket = $client_ids[$room_member_id];
                        if (socket_write($write_socket, $write_buf, strlen($write_buf)) === false){
                            echo "socket_write() failed: rason: " . socket_strerror(socket_last_error($write_socket));
                            $client_id = array_search($write_socket, $client_ids);
                            unset($read_sockets[$read_key]);
                            unset($client_ids[$client_id]);
                            $room_id_key = array_search($client_id, $room_list[$client_list[$client_id]['room']]);
                            unset($room_list[$client_list[$client_id]['room']][$room_id_key]);
                            unset($client_list[$client_id]);
                        }
                    }
                }
            }
        }
    }
    //There is no readable socket
    else if($select == 0){
        continue;
    }
    //select error
    else if($select === false){
        echo "socket_select() failed: reason: ". sockets_strerror(socket_last_error($read_sock)) . "\n";
        break;
    }
}
//close socket
socket_close($sock);
