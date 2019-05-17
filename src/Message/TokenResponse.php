<?php

namespace Omnipay\MercadoPago\Message;

use Omnipay\Common\Message\AbstractResponse;

class TokenResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return isset($this->data->access_token);
    }

    public function getToken()
    {
        return $this->data->access_token;
    }

}

?>
