<?php

namespace RedPacket\Result;

use RedPacket\Core\RPException;
use RedPacket\Http\ResponseCore;

class ApiResult
{

    function __construct(ResponseCore $response)
    {
        if ($response->isOK()) {
            $data = json_decode($response->body);
            return $data;
        } else {
            throw new RPException('http status is not 2xx');
        }
    }
}
