<?php
/**
 * This class defines integration tests to verify interface and
 * functionality of the Customer resource.
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
 * @link  http://dev.heidelpay.com/
 *
 * @author  Simon Gabriel <development@heidelpay.com>
 *
 * @package  heidelpayPHP/test/integration
 */
namespace heidelpayPHP\test\integration;

use heidelpayPHP\Constants\ApiResponseCodes;
use heidelpayPHP\Exceptions\HeidelpayApiException;
use heidelpayPHP\Resources\PaymentTypes\Giropay;
use heidelpayPHP\test\BasePaymentTest;
use PHPUnit\Framework\ExpectationFailedException;

class ExceptionTest extends BasePaymentTest
{
    /**
     * Verify that the HeidelpayApiException holds a special message for for the client.
     *
     * @test
     *
     * @throws HeidelpayApiException
     * @throws ExpectationFailedException
     * @throws \RuntimeException
     */
    public function apiExceptionShouldHoldClientMessage()
    {
        $giropay = $this->heidelpay->createPaymentType(new Giropay());
        try {
            $this->heidelpay->authorize(1.0, 'EUR', $giropay, self::RETURN_URL);
        } catch (HeidelpayApiException $e) {
            $this->assertInstanceOf(HeidelpayApiException::class, $e);
            $this->assertEquals(ApiResponseCodes::API_ERROR_TRANSACTION_AUTHORIZE_NOT_ALLOWED, $e->getCode());
            $this->assertNotEmpty($e->getClientMessage());
            $this->assertNotEquals($e->getMerchantMessage(), $e->getClientMessage());
        }
    }
}
