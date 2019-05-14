<?php

namespace Omnipay\MercadoPago\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Complete Payment Response
 */
class CompletePurchaseResponse extends AbstractResponse
{
    /*
     * Is this complete purchase response successful? Return true if status is approved
     * @return bool
     */
    public function isSuccessful()
    {
        return isset($this->data['status']) && $this->data['status'] == 'approved';
    }

    /**
     * This response never redirects
     *
     * @return bool
     */
    public function isRedirect()
    {
        return false;
    }

    /**
     * The transaction reference obtained from the purchase()
     *
     * @return string
     */
    public function getTransactionReference()
    {
        return $this->data['order_id'];
    }
}
