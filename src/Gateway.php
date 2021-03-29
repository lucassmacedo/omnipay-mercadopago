<?php

namespace Omnipay\MercadoPago;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\ItemBag;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'MercadoPago';
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

    public function setAccessToken($value)
    {
        return $this->setParameter('access_token', $value);
    }

    public function getAccessToken()
    {
        return $this->getParameter('access_token');
    }

    public function setNotificationUrl($value)
    {
        return $this->setParameter('notification_url', $value);
    }

    public function getNotificationUrl()
    {
        return $this->getParameter('notification_url');
    }

    public function setExternalReference($value)
    {
        return $this->setParameter('external_reference', $value);
    }

    public function getExternalReference()
    {
        return $this->getParameter('external_reference');
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\MercadoPago\Message\PurchaseRequest', $parameters);
    }
    public function requestToken(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\MercadoPago\Message\TokenRequest', $parameters);
    }
    /**
     * @param  array  $parameters
     * @return \Omnipay\MercadoPago\Message\CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\MercadoPago\Message\CompletePurchaseRequest', $parameters);
    }

}
