<?php

namespace Omnipay\MercadoPago\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $liveEndpoint = 'https://api.mercadopago.com';
    protected $testEndpoint = 'https://api.mercadopago.com';

    public function getData()
    {
        $data = $this->getExternalReference();
        return $data;
    }

    public function sendData($data)
    {
        $url = $this->getEndpoint() . '?access_token=' . $this->getAccessToken();
        $httpRequest = $this->httpClient->createRequest(
            'POST',
            $url,
            array(
                'Content-type' => 'application/json',
            ),
            $this->toJSON($data)
        );
        $httpResponse = $httpRequest->send();
        return $this->createResponse($httpResponse->json());
    }

    public function setExternalReference($value)
    {
        return $this->setParameter('external_reference', $value);
    }

    public function getExternalReference()
    {
        return $this->getParameter('external_reference');
    }

    public function setAccessToken($value)
    {
        return $this->setParameter('access_token', $value);
    }

    public function getAccessToken()
    {
        return $this->getParameter('access_token');
    }

    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    public function toJSON($data, $options = 0)
    {
        if (version_compare(phpversion(), '5.4.0', '>=') === true) {
            return json_encode($data, $options | 64);
        }
        return str_replace('\\/', '/', json_encode($data, $options));
    }

}

?>
