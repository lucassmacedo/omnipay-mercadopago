<?php

namespace Omnipay\MercadoPago\Message;

class CompletePurchaseRequest extends AbstractRequest
{
    protected $liveEndpoint = 'https://api.mercadopago.com/merchant_orders/';
    /** @var this option is unavailable */
    protected $testEndpoint = 'https://api.mercadopago.com/merchant_orders/';


    public function getData()
    {
        //get information about collection
        $id = $this->httpRequest->query->get('merchant_order_id');
        $url = $this->getEndpoint() . "$id?access_token=" . $this->getAccessToken();

        $httpRequest = $this->httpClient->request(
            'GET',
            $url,
            array(
                'Content-type' => 'application/json',
            )
        );
        $response = json_decode($httpRequest->getBody()->getContents());

        return isset($response) ? $response : null;
    }

    public function sendData($data)
    {
        return $this->createResponse($data);
    }

    protected function createResponse($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }

}