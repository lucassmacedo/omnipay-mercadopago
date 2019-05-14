<?php

namespace Omnipay\MercadoPago\Message;

class TokenRequest extends AbstractRequest
{
    protected $liveEndpoint = 'https://api.mercadopago.com/oauth/token';
    protected $testEndpoint = 'https://api.mercadopago.com/oauth/token';

    public function getData()
    {
        $this->setGrantType("client_credentials");
        return [
            'grant_type' => $this->getGrantType(),
            'client_id' => $this->getClientId(),
            'client_secret' => $this->getClientSecret()
        ];
    }

    public function sendData($data)
    {
        $url = $this->getEndpoint();
        $headers = [
           'headers' => ['Content-Type' => 'x-www-form-urlencoded; charset=UTF-8', 'Accept' => 'application/json']
        ];
        $httpResponse = $this->httpClient->post($url, $headers, $data)->send();
        return $this->createResponse($httpResponse->json());
    }

    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    public function getClientId()
    {
        return $this->getParameter('client_id');
    }

    public function setClientId($value)
    {
        return $this->setParameter('client_id', $value);
    }

    public function getClientSecret()
    {
        return $this->getParameter('client_secret');
    }

    public function setClientSecret($value)
    {
        return $this->setParameter('client_secret', $value);
    }

    public function getGrantType()
    {
        return $this->getParameter('grant_type');
    }

    public function setGrantType($value)
    {
        return $this->setParameter('grant_type', $value);
    }

    protected function createResponse($data)
    {
        return $this->response = new TokenResponse($this, $data);
    }

}

?>
