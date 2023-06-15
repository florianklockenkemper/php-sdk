<?php
/*
 *  Helper class to manage environment variables for testing.
 *
 *  Copyright (C) 2023 - today Unzer E-Com GmbH
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *  http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 *
 *  @link  https://docs.unzer.com/
 *
 */

namespace UnzerSDK\test\Helper;

use UnzerSDK\Services\EnvironmentService;

class TestEnvironmentService extends EnvironmentService
{
    /** @const Primary testing Keypair used as default for most payment types. */
    public const ENV_VAR_TEST_PRIVATE_KEY_1 = 'UNZER_PAPI_TEST_PRIVATE_KEY_1';
    public const ENV_VAR_TEST_PUBLIC_KEY_1 = 'UNZER_PAPI_TEST_PUBLIC_KEY_1';

    /** @const  Secondary keypair with mainly used for payment methods that need a second configuration to be tested. */
    public const ENV_VAR_TEST_PRIVATE_KEY_2 = 'UNZER_PAPI_TEST_PRIVATE_KEY_2';
    public const ENV_VAR_TEST_PUBLIC_KEY_2 = 'UNZER_PAPI_TEST_PUBLIC_KEY_2';

    /** @const  Third keypair mainly used for deprecated payment methods. */
    public const ENV_VAR_TEST_PRIVATE_KEY_3 = 'UNZER_PAPI_TEST_PRIVATE_KEY_3';
    public const ENV_VAR_TEST_PUBLIC_KEY_3 = 'UNZER_PAPI_TEST_PUBLIC_KEY_3';
    public const ENV_VAR_TEST_APPLE_MERCHANT_ID_FOLDER = 'UNZER_APPLE_MERCHANT_ID_PATH';
    public const ENV_VAR_TEST_APPLE_CA_CERTIFICATE = 'UNZER_APPLE_CA_CERTIFICATE_PATH';
    public const ENV_VAR_NAME_VERBOSE_TEST_LOGGING = 'UNZER_PAPI_VERBOSE_TEST_LOGGING';

    /**
     * Returns the CA certificate path set via environment variable.
     *
     * @return string
     */
    public static function getAppleCaCertificatePath(): string
    {
        return stripslashes($_SERVER[self::ENV_VAR_TEST_APPLE_CA_CERTIFICATE] ?? '');
    }

    /**
     * Returns the path to apple merchant ID folder set via environment variable.
     *
     * @return string
     */
    public static function getAppleMerchantIdPath(): string
    {
        return stripslashes($_SERVER[self::ENV_VAR_TEST_APPLE_MERCHANT_ID_FOLDER] ?? '');
    }

    /**
     * Returns false if the logging in tests is deactivated by environment variable.
     *
     * @return bool
     */
    public static function isTestLoggingActive(): bool
    {
        return EnvironmentService::getBoolEnvValue(self::ENV_VAR_NAME_VERBOSE_TEST_LOGGING);
    }

    /**
     * Returns the public key string set via environment variable.
     * Returns the non 3ds version of the key if the non3ds flag is set.
     * Returns an empty string if the environment variable is not set.
     *
     * @param bool $non3ds
     *
     * @return string
     */
    public static function getTestPublicKey(bool $non3ds = false): string
    {
        $variableName = $non3ds ? self::ENV_VAR_TEST_PUBLIC_KEY_2 : self::ENV_VAR_TEST_PUBLIC_KEY_1;
        $key = stripslashes($_SERVER[$variableName] ?? '');
        return empty($key) ? '' : $key;
    }

    /**
     * Returns the public key containing legacy payment methods.
     *
     * @param bool $non3ds
     *
     * @return string
     */
    public static function getLegacyTestPublicKey(): string
    {
        return stripslashes($_SERVER[self::ENV_VAR_TEST_PUBLIC_KEY_3] ?? '');
    }

    /**
     * Returns the private key string set via environment variable.
     * Returns the non 3ds version of the key if the non3ds flag is set.
     * Returns an empty string if the environment variable is not set.
     *
     * @param bool $non3ds
     *
     * @return string
     */
    public static function getTestPrivateKey(bool $non3ds = false): string
    {
        $variableName = $non3ds ? self::ENV_VAR_TEST_PRIVATE_KEY_2 : self::ENV_VAR_TEST_PRIVATE_KEY_1;
        $key = stripslashes($_SERVER[$variableName] ?? '');
        return empty($key) ? '' : $key;
    }

    public static function getLegacyTestPrivateKey(): string
    {
        return stripslashes($_SERVER[self::ENV_VAR_TEST_PRIVATE_KEY_3] ?? '');
    }
}
