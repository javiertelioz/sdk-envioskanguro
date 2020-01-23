<?php

declare(strict_types=1);

/**
 * @author      Javier Telio Z <jtelio118@gmail.com>
 * @category    EnviosKanguro
 * @package     EnviosKanguro_Api
 * @license     http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 * @copyright   Copyright (c) 2020 EnviosKanguro (https://envioskanguro.com/)
 */

namespace EnviosKanguro;

use EnviosKanguro\Config;

class Api
{
    /**
     * Mode (production or development)
     * default is production
     */
    protected $mode;

    /**
     * Access Token
     * @var string
     */
    protected $token;

    /**
     * Set variables to connect in Envios Kanguro ('production', 'development')
     * default 'development'
     * 
     * @param string $token
     * @param string $mode
     */
    public function __construct($token, $mode = 'development')
    {
        $this->token = $token;
        $this->mode = $mode;
    }

    /**
     * Execute a POST Request
     *
     * @param string $body
     * @param array $params
     * @return mixed
     */
    public function post($path, $body = [], $params = [])
    {
        $body = json_encode($body);

        $opts = [
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Authorization: Bearer " . $this->token,
                "Cache-Control: no-cache",
                "Content-Type: application/json",
            ],
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $body
        ];

        $exec = $this->execute($path, $opts, $params);

        return $exec;
    }

    /**
     * Execute a GET Request
     *
     * @param string $path
     * @param array $params
     * @return mixed
     */
    public function get($path, $params = null)
    {
        $opts = [
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer " . $this->token,
                "Cache-Control: no-cache",
            ]
        ];

        $exec = $this->execute($path, $opts, $params);

        return $exec;
    }

    /**
     * Execute a PUT Request
     *
     * @param string $path
     * @param string $body
     * @param array $params
     * @return mixed
     */
    public function put($path, $body = [], $params)
    {
        if (!empty($body)) {
            $body = json_encode($body);
        }

        $opts = [
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Authorization: Bearer " . $this->token,
                "Cache-Control: no-cache",
                "Content-Type: application/json",
            ],
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => $body
        ];

        $exec = $this->execute($path, $opts, $params);

        return $exec;
    }

    /**
     * Execute a DELETE Request
     *
     * @param string $path
     * @param array $params
     * @return mixed
     */
    public function delete($path, $params)
    {
        $opts = [
            CURLOPT_CUSTOMREQUEST => "DELETE"
        ];

        $exec = $this->execute($path, $opts, $params);

        return $exec;
    }

    /**
     * Execute a OPTION Request
     *
     * @param string $path
     * @param array $params
     * @return mixed
     */
    public function options($path, $params = null)
    {
        $opts = [
            CURLOPT_CUSTOMREQUEST => "OPTIONS"
        ];

        $exec = $this->execute($path, $opts, $params);

        return $exec;
    }

    /**
     * Execute all requests and returns response body and headers
     *
     * @param string $path
     * @param array $opts
     * @param array $params
     * @return mixed
     */
    public function execute($path, $opts = [], $params = []) : array
    {
        $uri = $this->makeUrl($path, $params);

        $ch = curl_init($uri);

        curl_setopt_array($ch, Config::CURL_OPTS);

        if (!empty($opts)) {
            curl_setopt_array($ch, $opts);
        }

        try {
            $response = curl_exec($ch);
        } catch (\Exception $e) {
            throw $e;
        }

        $error = curl_error($ch);

        if ($error) {
            throw new \Exception("cURL Error #: " . $error, 1);
        }

        $result = [
            "body"      => json_decode($response),
            "http_code" => curl_getinfo($ch, CURLINFO_HTTP_CODE),
        ];

        curl_close($ch);

        return $result;
    }

    /**
     * Check and construct an real URL to make request
     *
     * @param string $path
     * @param array $params
     * @return string
     */
    public function makeUrl($path, $params = []): string
    {
        if (!preg_match("/^http/", $path)) {

            if (!preg_match("/^\//", $path)) {
                $path = '/' . $path;
            }

            $uri = Config::ENVIRONMENTS[$this->mode] . $path;
        } else {
            $uri = $path;
        }

        if (!empty($params)) {
            $params = '?' . http_build_query($params);
            $uri .= $params;
        }

        return $uri;
    }
}
