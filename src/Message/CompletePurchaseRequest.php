<?php

namespace Omnipay\MercadoPago\Message;

class CompletePurchaseRequest extends AbstractRequest
{
    protected $liveEndpoint = 'https://api.mercadopago.com/collections/notifications/';
    /** @var this option is unavailable */
    protected $testEndpoint = 'https://api.mercadolibre.com/sandbox/collections/notifications/';


    public function getData()
    {
        //get information about collection
        $id = $this->httpRequest->query->get('collection_id');
        $url = $this->getEndpoint() . "$id?access_token=" . $this->getAccessToken();
        $httpRequest = $this->httpClient->createRequest(
            'GET',
            $url,
            array(
                'Content-type' => 'application/json',
            )
        );
        $httpResponse = $httpRequest->send();
        $response = $httpResponse->json();
        return isset($response['collection']) ? $response['collection'] : null;
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

?>
