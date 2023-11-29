<?php

namespace Thiio\ActiveCampaign;

use Thiio\ActiveCampaign\requesters\Connections;
use Thiio\ActiveCampaign\requesters\Contacts;
use Thiio\ActiveCampaign\requesters\Customers;
use Thiio\ActiveCampaign\requesters\Lists;
use Thiio\ActiveCampaign\requesters\Orders;
use Thiio\ActiveCampaign\requesters\OrderProducts;
use Thiio\ActiveCampaign\requesters\Tags;
use WebforceHQ\Exceptions\EmptyCredentialsException;
use WebforceHQ\Exceptions\ParametersRequiredException;


class ActiveCampaign
{

    protected $api_url;
    protected $api_key;


    public function __construct(string $api_url = null, $api_key = null)
    {
        $this->initialize($api_url, $api_key);
    }

    public function initialize($url, $key)
    {
        $this->setBase($url);
        $this->setApi($key);
    }

    public function setBase($url)
    {
        $this->api_url = $url;
    }

    public function getBaseUrl()
    {
        return $this->api_url;
    }

    public function setApi($key)
    {
        $this->api_key = $key;
    }

    public function getApiKey()
    {
        return $this->api_key;
    }

    protected function hasCredentials()
    {
        return $this->api_key && $this->api_url;
    }

    protected function validateCredentials()
    {
        if (!$this->validateCredentials()) {
            throw new EmptyCredentialsException();
        }
    }

    // public function __call($method,$args){
    //     if( ! method_exists($this, $method) ){
    //         throw new UnknownMethodException("Method {$method} does not exists");
    //     }
    // }

    protected function required($parameter, $method)
    {
        if (!$parameter) {
            throw new ParametersRequiredException("{$method} requires parameter not to be null");
        }
    }

    public function contacts()
    {
        return new Contacts($this);
    }

    public function tags()
    {
        return new Tags($this);
    }

    public function lists()
    {
        return new Lists($this);
    }

    public function customers()
    {
        return new Customers($this);
    }

    public function orders()
    {
        return new Orders($this);
    }

    public function connections()
    {
        return new Connections($this);
    }

    public function orderProducts()
    {
        return new OrderProducts($this);
    }
}
