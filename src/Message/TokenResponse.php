<?php

namespace Omnipay\MercadoPago\Message;

use Omnipay\Common\Message\AbstractResponse;

class TokenResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return isset($this->data['status']) && in_array($this->data['status'], array('Success', 'SuccessWithWarning'));
    }
}

?>
