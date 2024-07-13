<?php

declare(strict_types=1);



/**
 * lightweight library for socketing server and client side
 *
 * @version 1.0.0
 * @author Mr Afaz
 * @package esock
 * @copyright Copyright 2024 esock library
 * @license https://opensource.org/licenses/MIT
 * @link https://github.com/imafaz/neili
 */

namespace Esock;

error_reporting(0);


/**
 * @method array initServer(string $ip, int $port)
 * @method array initClient(string $ip, int $port)
 * @method array accept()
 * @method array read(object $socket)
 * @method array write(object $socket, string|int $output)
 * @method string keyboard(string $secretToken = null)
 * @method array close(object $socket)
 */
class Esock
{

    /**
     * socket ip
     *
     * @var string
     */
    private string $ip;


    /**
     * socket port
     *
     * @var int
     */
    private int $port;

    /**
     * socket object
     *
     * @var object
     */
    private $socket;

    /**
     * socket last error
     *
     * @var object
     */
    public $lastError;

    /**
     * initServer: initial server side
     * 
     * @param  string $ip
     * @param  int $port
     * 
     * @return array
     */
    public function initServer(string $ip, int $port)
    {
        $this->ip = $ip;
        $this->port = $port;
        $this->socket = socket_create(AF_INET, SOCK_STREAM, 0);
        if ($this->socket === false) {
            $this->lastError = socket_strerror(socket_last_error());
            return false;
        }
        $result = socket_bind($this->socket,  $this->ip, $this->port);
        if ($result === false) {
            $this->lastError = socket_strerror(socket_last_error());
            return false;
        }
        $result = socket_listen($this->socket, 3);
        if ($result === false) {
            $this->lastError = socket_strerror(socket_last_error());
            return false;
        }
        return true;
    }

    /**
     * initClient: initial client side
     * 
     * @param  string $ip
     * @param  int $port
     * 
     * @return array
     */
    public function initClient(string $ip, int $port)
    {
        $this->ip = $ip;
        $this->port = $port;
        $this->socket = socket_create(AF_INET, SOCK_STREAM, 0);
        if ($this->socket === false) {
            $this->lastError = socket_strerror(socket_last_error());
            return false;
        }
        $server = socket_connect($this->socket, $this->ip, $this->port);
        if ($server === false) {
            $this->lastError = socket_strerror(socket_last_error());
            return false;
        }
        return $this->socket;
    }


    /**
     * accept: accept connection in server side
     * 
     * @return socket object
     */
    public function accept()
    {
        $client = socket_accept($this->socket);
        if ($client === false) {
            $this->lastError = socket_strerror(socket_last_error());
            return false;
        }
        return $client;
    }

    /**
     * read: read socket
     * 
     * @param  object $socket
     * 
     * @return array
     */
    public function read(object $socket)
    {

        $input = socket_read($socket, 1024);
        if ($input === false) {
            $this->lastError = socket_strerror(socket_last_error());
            return false;
        }
        return trim($input);
    }

    /**
     * write: write socket
     * 
     * @param  object $socket
     * @param  string $output
     * 
     * @return array
     */
    public function write(object $socket, string|int $output)
    {
        $result = socket_write($socket, $output, strlen($output));
        if ($result === false) {
            $this->lastError = socket_strerror(socket_last_error());
            return false;
        }
        return true;
    }

    /**
     * close: close socket
     * 
     * @param  object $socket
     * 
     * @return array
     */
    public function close(object $socket)
    {
        $result = socket_close($socket);
        if ($result === false) {
            $this->lastError = socket_strerror(socket_last_error());
            return false;
        }
        return true;
    }

}
