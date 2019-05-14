<?php

namespace Omnipay\MercadoPago;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setClientId("1409715019698491");
        $this->gateway->setClientSecret("PNGxKb6I7mqs1npFwCf4nDqRfSMqAOpE");
        $this->gateway->setExternalReference(178);
        $item = new Item();
        $item->setName("PurchaseTest");
        $item->setCategoryId("tickets");
        $item->setQuantity(1);
        $item->setCurrencyId("BRL");
        $item->setPrice(10.0);
        $this->items = array("items" => [$item]);
    }

    public function testPurchase()
    {
        $responseToken = $this->gateway->requestToken($this->items)->send();
        $dataToken = $responseToken->getData();
        $this->gateway->setAccessToken($dataToken['access_token']);
        $this->assertInstanceOf('\Omnipay\MercadoPago\Message\TokenResponse', $responseToken);
        $this->assertTrue($this->gateway->getAccessToken() != null);

        $response = $this->gateway->purchase($this->items)->send();
        $data = $response->getData();
        $this->assertInstanceOf('\Omnipay\MercadoPago\Message\PurchaseResponse', $response);
        $this->assertTrue($data['init_point'] != null);
    }
}

?>
