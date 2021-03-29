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
            'client_id'     => $this->getClientId(),
            'client_secret' => $this->getClientSecret(),
            'grant_type'    => $this->getGrantType(),
        ];
    }

    public function sendData($data)
    {
        $url = $this->getEndpoint();
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        $httpResponse = $this->httpClient->request('POST', $url, $headers, http_build_query($data, '', '&'));

        return ($this->createResponse(json_decode($httpResponse->getBody()->getContents())));
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