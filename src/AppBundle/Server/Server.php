<?php

namespace AppBundle\Server;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Server implements MessageComponentInterface
{
    protected $clients;
    protected $session;

    public function __construct($session)
    {
        $this->clients = new \SplObjectStorage;
        $this->session = $session;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
        $this->session->setId($conn->WebSocket->request->getCookie(ini_get('session.name')));
        $this->session->all();
        echo 'Hello '.$this->session->get('username').' (id: '.$this->session->get('user_id').")!\n";
        //echo var_dump($conn->Session->all());
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
        , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        foreach ($this->clients as $client)
        {
            if ($from !== $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    public function sendData($entry)
    {
        foreach ($this->clients as $client)
        {
            $dataReceived = json_decode($entry, true);

            $dataToSend['date'] = $dataReceived['date'];
            $dataToSend['datacenters'] = $dataReceived['users'][$client->Session->get('user_id')]['datacenters'];

            $json = json_encode($dataToSend);
            //echo var_dump($client->Session->all());
            $client->send($json);
        }
    }
}
