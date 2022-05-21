<?php

function getStringToDateFromatDmy($date) {
    getTimeZone();
    return $result = date("d-m-Y", strtotime($date));
}

function getStringToDateFromat($date) {
    getTimeZone();
    return $result = date("Y-m-d", strtotime($date));
}

if (!function_exists('getUnitArray')) {

    /**
     * @return array
     */
    function getUnitArray()
    {
        return array('Kg', 'Liter', 'Piece');
    }
}

if (!function_exists('isAllowedDownloadCustomerIdArray')) {

    /**
     * @return array
     */
    function isAllowedDownloadCustomerIdArray()
    {
        return array();
    }
}

if (!function_exists('isLiveModeActive')) {

    /**
     * @param false $flag
     * @return false|mixed
     */
    function isLiveModeActive($flag = false)
    {
        $ipArray = array('127.0.0.1');
        if (in_array(getIpAddress(), $ipArray)) {
            return true;
        }
        return true;
    }
}

if (!function_exists('getIpAddress')) {

    /**
     * @return string|null
     */
    function getIpAddress()
    {
        return $clientIP = request()->ip();
    }
}

if (!function_exists('base64_url_encode')) {
    /**
     * @param $input
     * @return string
     */
    function base64_url_encode($input)
    {
        return strtr(base64_encode($input), '+/=', '._-');
    }
}

if (!function_exists('base64_url_decode')) {
    /**
     * @param $input
     * @return false|string
     */
    function base64_url_decode($input)
    {
        return base64_decode(strtr($input, '._-', '+/='));
    }
}

if (!function_exists('base64Encode')) {
    /**
     * @param $string
     * @return string
     */
    function base64Encode($string)
    {
        return $encoded = base64_encode(uniqid() . $string);
    }
}

if (!function_exists('base64Decode')) {
    /**
     * @param $string
     * @return false|string
     */
    function base64Decode($string)
    {
        return $decoded = substr(base64_decode($string), 13);
    }
}

if (!function_exists('getFirstNChar')) {
    /**
     * @param $string
     * @param $length
     * @param string $dots
     * @return mixed|string
     */
    function getFirstNChar($string, $length, $dots = "")
    {
        return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
    }
}

if (!function_exists('convertNumberToWords')) {

    /**
     * @param $number
     * @return bool|string
     */
    function convertNumberToWords($number)
    {
        $number = !empty($number) ? doubleval($number) : 0;
        $hyphen = '-';
        $conjunction = ' and ';
        $separator = ', ';
        $negative = 'negative ';
        $decimal = ' point ';
        $dictionary = array(
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'fourty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
            100 => 'hundred',
            1000 => 'thousand',
            1000000 => 'million',
            1000000000 => 'billion',
            1000000000000 => 'trillion',
            1000000000000000 => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );
        if (!is_numeric($number)) {
            return false;
        }
        if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convertNumberToWords only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
            );
            return false;
        }
        if ($number < 0) {
            return $negative . convertNumberToWords(abs($number));
        }
        $string = $fraction = null;
        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }
        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int)($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . convertNumberToWords($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int)($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convertNumberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= convertNumberToWords($remainder);
                }
                break;
        }
        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string)$fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }
        return $string;
    }
}

if (!function_exists('getTimeZone')) {

    /**
     * @return bool
     */
    function getTimeZone()
    {
        $ipAddressArray = array('127.0.0.1', '::1');
        if (in_array($_SERVER['REMOTE_ADDR'], $ipAddressArray)) {
            return date_default_timezone_set("Asia/Dhaka");
        }
        return date_default_timezone_set("Asia/Dhaka");
    }
}

if (!function_exists('getCurrentYear')) {

    /**
     * @return false|string
     */
    function getCurrentYear()
    {
        getTimeZone();
        return date('Y');
    }
}

if (!function_exists('getPercentageSign')) {

    /**
     * @param bool $parentheses
     * @return string
     */
    function getPercentageSign($parentheses = false)
    {
        return ($parentheses) ? '(%)' : '%';
    }
}

if (!function_exists('getUriLastSegment')) {

    /**
     * @param null $uriPath
     * @return mixed|string|null
     */
    function getUriLastSegment($uriPath = null)
    {
        if (!empty($uriPath)) {
            $uriParts = explode('/', $uriPath);
            $lastSegments = end($uriParts);
        } else {
            $lastSegments = request()->segment(count(request()->segments()));
        }
        return $lastSegments;
    }
}

if (!function_exists('getEncryptDecryptCredential')) {

    /**
     * @return string[]
     */
    function getEncryptDecryptCredential()
    {
        $credential = array();
        $secret_key = 'Bangladesh';
        $secret_iv = 'Cricket2020';
        return $credential = array(
            'secret_key' => $secret_key,
            'secret_iv' => $secret_iv,
        );
    }
}

if (!function_exists('passwordEncrypt')) {

    /**
     * @param $string
     * @return string
     */
    function passwordEncrypt($string)
    {
        $output = false;
        $credential = getEncryptDecryptCredential();
        $encrypt_method = "AES-256-CBC";
        $secret_key = array_key_exists('secret_key', $credential) ? $credential['secret_key'] : '';
        $secret_iv = array_key_exists('secret_iv', $credential) ? $credential['secret_iv'] : '';
        // hash
        $key = hash('sha256', $secret_key);
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }
}

if (!function_exists('passwordDecrypt')) {

    /**
     * @param $string
     * @return string
     */
    function passwordDecrypt($string)
    {
        $output = false;
        $credential = getEncryptDecryptCredential();
        $encrypt_method = "AES-256-CBC";
        $secret_key = array_key_exists('secret_key', $credential) ? $credential['secret_key'] : '';
        $secret_iv = array_key_exists('secret_iv', $credential) ? $credential['secret_iv'] : '';
        // hash
        $key = hash('sha256', $secret_key);
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        return $output;
    }
}

if (!function_exists('getCompanyName')) {
    /**
     *
     * @return string a string of company_name
     *
     * */
    function getCompanyName()
    {
        $key = 'company_name';
        $arr = getCompanyInformation();
        return getArrayValueByKey($key, $arr);
    }
}

if (!function_exists('getCompanyEmail')) {
    /**
     *
     * @return string a string of company_email
     *
     * */
    function getCompanyEmail()
    {
        $key = 'company_email';
        $arr = getCompanyInformation();
        return getArrayValueByKey($key, $arr);
    }
}

if (!function_exists('getCompanyMobile')) {
    /**
     *
     * @return string a string of company_mobile
     *
     * */
    function getCompanyMobile()
    {
        $key = 'company_mobile';
        $arr = getCompanyInformation();
        return getArrayValueByKey($key, $arr);
    }
}

if (!function_exists('getCompanyTelephone')) {
    /**
     *
     * @return string a string of company_telephone
     *
     * */
    function getCompanyTelephone()
    {
        $key = 'company_telephone';
        $arr = getCompanyInformation();
        return getArrayValueByKey($key, $arr);
    }
}

if (!function_exists('getCompanyWebsite')) {
    /**
     *
     * @return string a string of company_website
     *
     * */
    function getCompanyWebsite()
    {
        $key = 'company_website';
        $arr = getCompanyInformation();
        return getArrayValueByKey($key, $arr);
    }
}

if (!function_exists('getCompanyAddress')) {
    /**
     *
     * @return string a string of company_address
     *
     * */
    function getCompanyAddress()
    {
        $key = 'company_address';
        $arr = getCompanyInformation();
        return getArrayValueByKey($key, $arr);

    }
}

if (!function_exists('getCompanyVatRegistration')) {
    /**
     *
     * @return string a string of company_vat_registration
     *
     * */
    function getCompanyVatRegistration()
    {
        $key = 'company_vat_registration';
        $arr = getCompanyInformation();
        return getArrayValueByKey($key, $arr);
    }
}

if (!function_exists('getCompanyFacebookUrl')) {
    /**
     *
     * @return string a string of company_facebook_url
     *
     * */
    function getCompanyFacebookUrl()
    {
        $key = 'company_facebook_url';
        $arr = getCompanyInformation();
        return getArrayValueByKey($key, $arr);
    }
}

if (!function_exists('getCompanySkypeUrl')) {
    /**
     *
     * @return string a string of company_skype_url
     *
     * */
    function getCompanySkypeUrl()
    {
        $key = 'company_skype_url';
        $arr = getCompanyInformation();
        return getArrayValueByKey($key, $arr);
    }
}

if (!function_exists('getCompanyTwitterUrl')) {
    /**
     *
     * @return string a string of company_twitter_url
     *
     * */
    function getCompanyTwitterUrl()
    {
        $key = 'company_twitter_url';
        $arr = getCompanyInformation();
        return getArrayValueByKey($key, $arr);
    }
}

if (!function_exists('getCompanyInformation')) {

    /**
     * @return array
     */
    function getCompanyInformation()
    {
        return $companyInfoArray = array(
            'company_name' => trim('Construction Details'),
            'company_email' => trim('info@construction.com'),
            'company_mobile' => trim('+8801753996688'),
            'company_telephone' => trim('+8801753996688'),
            'company_website' => trim('https://construction.com/'),
            'company_address' => trim('21, Purana Paltan, Dhaka-1000, Bangladesh'),
            'company_vat_registration' => trim(''),
            'company_facebook_url' => trim('https://www.facebook.com/'),
            'company_skype_url' => trim('https://www.skype.com/en'),
            'company_twitter_url' => trim('https://twitter.com/?lang=en'),
        );
    }
}

if (!function_exists('getFloat')) {
    /**
     * Returns a folating point number
     *
     * @param integer $number
     * Numeric number to convert
     *
     * @param boolean $thousandsSeparator
     * Thousands Separator True(Allow) or False(Not Allow)
     *
     * @return double type number
     *
     * */
    function getFloat($number = 0, $thousandsSeparator = false)
    {
        return ($thousandsSeparator) ? number_format(doubleval($number), 2) : number_format(doubleval($number), 2, '.', '');
    }
}

if (!function_exists('getAmountWithCurrency')) {

    /**
     * @param int $amount
     * @param string $placement
     * @param bool $thousandsSeparator
     * @return string
     */
    function getAmountWithCurrency($amount = 0, $thousandsSeparator = false, $placement = 'left')
    {
//        $placement = getCurrencyPlacement();
        $amount = getFloat($amount, $thousandsSeparator);
        if (strtolower(trim($placement)) == trim('right')) {
            return $amount . getCurrency();
        } else if (strtolower(trim($placement)) == trim('left')) {
            return getCurrency() . $amount;
        } else {
            return getCurrency() . $amount;
        }
    }
}

if (!function_exists('getCurrency')) {
    /**
     * @param bool $symbol
     * @param bool $parentheses
     * @return string
     */
    function getCurrency($symbol = false, $parentheses = false)
    {
        $currency = ($symbol) ? '৳' : 'TK';
        return $parentheses ? '(' . $currency . ')' : $currency;
    }
}

if (!function_exists('getCurrencyPlacement')) {
    /**
     * @return string
     */
    function getCurrencyPlacement()
    {
        return $placement = 'left';
    }
}

if (!function_exists('getCurrencyIsoCode')) {
    /**
     * @param bool $parentheses
     * @return string
     */
    function getCurrencyIsoCode($parentheses = false)
    {
        $isoCode = "BDT";
        return $parentheses ? '(' . $isoCode . ')' : $isoCode;
    }
}

if (!function_exists('getArrayValueByKey')) {
    /**
     * @param $searchableKey
     * @param $array
     * @return mixed|string
     */
    function getArrayValueByKey($searchableKey, $array)
    {
        $result = '';
        return array_key_exists($searchableKey, $array) ? $array[$searchableKey] : '';
//    foreach ($array as $key => $value) {
//        if ($key == $searchableKey) {
//            $result = $value;
//            break;
//        }
//    }
//    return $result;
    }
}

if (!function_exists('getPrintr')) {
    /**
     *
     * @param $expression
     * @return void
     *
     */
    function getPrintr($expression)
    {
        echo '<pre>';
        print_r($expression);
        echo '</pre>';
        exit;
    }
}

if (!function_exists('getVarDump')) {
    /**
     *
     * @param $expression
     * @return void
     *
     */
    function getVarDump($expression)
    {
        echo '<pre>';
        var_dump($expression);
        echo '</pre>';
        exit;
    }
}


