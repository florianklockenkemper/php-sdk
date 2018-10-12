<?php
/**
 * This defines a base class for all payment types e.g. Card, GiroPay, etc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * @license http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * @copyright Copyright © 2016-present heidelpay GmbH. All rights reserved.
 *
 * @link  http://dev.heidelpay.com/
 *
 * @author  Simon Gabriel <development@heidelpay.com>
 *
 * @package  heidelpay/mgw_sdk/payment_types
 */
namespace heidelpay\MgwPhpSdk\Resources\PaymentTypes;

use heidelpay\MgwPhpSdk\Resources\AbstractHeidelpayResource;
use heidelpay\MgwPhpSdk\Resources\TransactionTypes\Authorization;
use heidelpay\MgwPhpSdk\Resources\TransactionTypes\Charge;
use heidelpay\MgwPhpSdk\Interfaces\PaymentTypeInterface;

abstract class BasePaymentType extends AbstractHeidelpayResource implements PaymentTypeInterface
{
    //<editor-fold desc="Overridable Methods">

    /**
     * {@inheritDoc}
     */
    public function getResourcePath()
    {
        return 'types/' . $this::getClassShortNameKebapCase();
    }

    //</editor-fold>

    //<editor-fold desc="Transaction methods">

    /**
     * {@inheritDoc}
     */
    public function charge($amount, $currency, $returnUrl, $customer = null): Charge
    {
        return $this->getHeidelpayObject()->charge($amount, $currency, $this, $returnUrl, $customer);
    }

    /**
     * {@inheritDoc}
     */
    public function authorize($amount, $currency, $returnUrl, $customer = null, $orderId = null): Authorization
    {
        return $this->getHeidelpayObject()->authorize($amount, $currency, $this, $returnUrl, $customer, $orderId);
    }

    //</editor-fold>
}
