<?php

namespace Jakub\ProductFrontend\Repositories;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException as GuzzleClientException;
use Jakub\ProductFrontend\Exceptions\RestClientException;


/**
 * Class ProductRest
 * @package Jakub\ProductFrontend\Repositories
 */
class ProductRest
{

    /**
     *
     */
    const REQUEST_POST = 'post';
    /**
     *
     */
    const REQUEST_GET = 'get';
    /**
     *
     */
    const REQUEST_PUT = 'put';
    /**
     *
     */
    const REQUEST_DELETE = 'delete';

    /**
     * @var array
     */

    protected $config;

    /**
     * @var mixed|string
     */
    protected $api_url;

    /**
     * @var Client
     */
    protected $client;

    /**
     * ProductRest constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->config = $config;
        $this->api_url = $config['api_url'] ?? '';
        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * @param $conditional
     * @return mixed
     * @throws RestClientException
     */
    public function getProducts($conditional)
    {
        $result = $this->request(self::REQUEST_GET, 'products', $conditional);
        return $result;
    }

    /**
     * @param $productId
     * @param $data
     * @return mixed
     * @throws RestClientException
     */
    public function editProduct($productId, $data)
    {
        $result = $this->request(self::REQUEST_PUT, 'product/' . $productId, $data);
        return $result;
    }

    /**
     * @param $data
     * @return mixed
     * @throws RestClientException
     */
    public function addProduct($data)
    {
        $result = $this->request(self::REQUEST_POST, 'product', $data);
        return $result;
    }

    /**
     * @param $productId
     * @return mixed
     * @throws RestClientException
     */
    public function deleteProduct($productId)
    {
        $result = $this->request(self::REQUEST_DELETE, 'product/' . $productId);
        return $result;
    }

    /**
     * @param $productId
     * @return mixed
     * @throws RestClientException
     */
    public function getProduct($productId)
    {
        $result = $this->request(self::REQUEST_GET, "product/" . $productId);
        return $result;
    }

    /**
     * @param $type
     * @param $method
     * @param array $data
     * @return mixed
     * @throws RestClientException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function request($type, $method, $data = [])
    {
        $url = $this->api_url . $method;

        if ($type == self::REQUEST_GET) {
            $data = ['query' => $data];
        } else {
            $data = ['form_params' => $data];
        }

        try {
            $req = $this->client->request($type, $url, $data);
        } catch (GuzzleClientException $e) {
            $result = json_decode($e->getResponse()->getBody(true), true);
            throw new RestClientException(array_get($result, 'errorMessage', 'Somethings went wrong.'));
        }
        $result = json_decode($req->getBody(), true);

        if ($result === null) {
            throw new \Exception("Problem with JSON");
        }

        return array_get($result, 'data');

    }
}