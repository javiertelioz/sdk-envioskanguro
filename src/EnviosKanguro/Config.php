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

class Config {

    /**
     * @version
     */
    const VERSION   = "1.0.0";

    /**
     * CURL Configuration
     */
    const CURL_OPTS = [
        CURLOPT_USERAGENT       => "ENVIOSKANGURO-SDK-PHP-" . self::VERSION,
        CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
        CURLOPT_SSL_VERIFYPEER  => false,
        CURLOPT_CONNECTTIMEOUT  => 10,
        CURLOPT_RETURNTRANSFER  => 1,
        CURLOPT_TIMEOUT         => 60,
        CURLOPT_MAXREDIRS       => 10,
    ];

    /**
     * Environments url
     */
    const ENVIRONMENTS = [
        "production"    => "https://api.envioskanguro.com/v1",
        "development"   => "https://apidev.envioskanguro.com/v1"
    ];
}
