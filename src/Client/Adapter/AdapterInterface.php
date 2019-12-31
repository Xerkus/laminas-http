<?php

/**
 * @see       https://github.com/laminas/laminas-http for the canonical source repository
 * @copyright https://github.com/laminas/laminas-http/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-http/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\Http\Client\Adapter;

/**
 * An interface description for Laminas_Http_Client_Adapter classes.
 *
 * These classes are used as connectors for Laminas_Http_Client, performing the
 * tasks of connecting, writing, reading and closing connection to the server.
 *
 * @category   Laminas
 * @package    Laminas_Http
 * @subpackage Client_Adapter
 */
interface AdapterInterface
{
    /**
     * Set the configuration array for the adapter
     *
     * @param array $options
     */
    public function setOptions($options = array());

    /**
     * Connect to the remote server
     *
     * @param string  $host
     * @param int     $port
     * @param  bool $secure
     */
    public function connect($host, $port = 80, $secure = false);

    /**
     * Send request to the remote server
     *
     * @param string        $method
     * @param \Laminas\Uri\Uri $url
     * @param string        $httpVer
     * @param array         $headers
     * @param string        $body
     * @return string Request as text
     */
    public function write($method, $url, $httpVer = '1.1', $headers = array(), $body = '');

    /**
     * Read response from server
     *
     * @return string
     */
    public function read();

    /**
     * Close the connection to the server
     *
     */
    public function close();
}
