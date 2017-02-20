<?php

namespace App\Services;

use \Storage as Storage;

class CurrencyService
{
    protected $usd;

    public function __construct()
    {
        $this->getUSDRate();
    }

    public function createCurrencyXml()
    {
        Storage::put('currency.xml', fopen("https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange", 'r'));
    }

    public function getUSDRate($precision=2)
    {
        if(Storage::has('currency.xml') != true)
            $this->createCurrencyXml();

        $currencyXml = simplexml_load_file(storage_path('app/currency.xml'));
        foreach ($currencyXml->currency as $currency) {
            if(strcasecmp(trim($currency->cc),'USD') == 0) $this->usd = $currency->rate;
        }
        $this->usd =  round((float)$this->usd,$precision);
        return $this->usd;
    }
}