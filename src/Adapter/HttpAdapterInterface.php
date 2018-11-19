<?php
/**
 * Http adapters to be used by this api have to implement this interface.
 *
 * Copyright (C) 2018 heidelpay GmbH
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @link  http://dev.heidelpay.com/heidelpay-php-payment-api/
 *
 * @author  Simon Gabriel <simon.gabriel@heidelpay.com>
 *
 * @package  heidelpay/mgw_sdk/adapter
 */
namespace heidelpay\MgwPhpSdk\Adapter;

use heidelpay\MgwPhpSdk\Resources\AbstractHeidelpayResource;

interface HttpAdapterInterface
{
    const REQUEST_POST = 'POST';
    const REQUEST_DELETE = 'DELETE';
    const REQUEST_PUT = 'PUT';
    const REQUEST_GET = 'GET';

    /**
     * send post request to payment server
     *
     * @param $uri string url of the target system
     * @param AbstractHeidelpayResource $heidelpayResource
     * @param $httpMethod
     *
     * @return string result json of the transaction
     */
    public function send(
        $uri = null,
        AbstractHeidelpayResource $heidelpayResource = null,
        $httpMethod = self::REQUEST_POST
    ): string;
}
