<?php

namespace Omnipay\MercadoPago\Message;

use Carbon\Carbon;
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
        return isset($this->data->status);
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

        return $this->data->id;
    }

    /**
     * The transaction reference obtained from the purchase()
     *
     * @return string
     */

    public function getTransactionDate()
    {
        return $this->isSuccessful() ? $this->data->date_created : null;
    }
}
