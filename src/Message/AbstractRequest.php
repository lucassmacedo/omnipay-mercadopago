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
        $httpRequest = $this->httpClient->request(
            'POST',
            $url,
            array(
                'Content-type' => 'application/json',
            ),
            $this->toJSON($data)
        );

        return $this->createResponse(json_decode($httpRequest->getBody()->getContents()));
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

    /**
     * Get Customer Data
     *
     * @return array customer data
     */
    public function getCustomer()
    {
        return $this->getParameter('customer');
    }

    /**
     * Set Customer data
     *
     * @param array $value
     * @return AbstractRequest provides a fluent interface.
     */
    public function setCustomer($value)
    {
        return $this->setParameter('customer', $value);
    }

    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    public function toJSON($data, $options = 0)
    {
        return json_encode($data, $options | 64);
    }

}