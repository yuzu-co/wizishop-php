<?php

namespace Yuzu\Wizishop;

use Yuzu\Wizishop\Http\Response;
use Yuzu\Wizishop\Request\LoginDefinition;
use Yuzu\Wizishop\Request\GetOrdersDefinition;
use Yuzu\Wizishop\Request\GetOrderDefinition;
use Yuzu\Wizishop\Request\GetCustomersDefinition;
use Yuzu\Wizishop\Request\GetCustomerDefinition;
use Yuzu\Wizishop\Request\GetNewsletterSubscribersDefinition;
use Yuzu\Wizishop\Request\RequestDefinitionInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;

/**
 * Class Client
 *
 * @author Jonathan Martin <john@yuzu.co>
 */
class Client
{
    const WIZISHOP_API_ENDPOINT = 'https://api.wizishop.com';
    
    private $username;
    
    private $password;
    
    private $token;
    
    private $shopId;
    
    protected $httpClient;
    
    /**
     * Constructor.
     * @param $apiToken
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
    
    public function setToken($token)
    {
        $this->token = $token;
    }
    
    public function getClient()
    {
        if (empty($this->httpClient)) {
            $this->httpClient = new GuzzleClient([
                'base_uri' => self::WIZISHOP_API_ENDPOINT
            ]);
        }
        
        return $this->httpClient;
    }
    
    private function send(RequestDefinitionInterface $definition)
    {
        try {
            $response = $this->getClient()->request(
                $definition->getMethod(),
                $definition->getUrl(),
                [
                    'body' => json_encode($definition->getBody()),
                    'headers' => $definition->authenticationRequired() ? [
                        'authorization' => sprintf('Bearer %s', $this->token)] : []
                ]
            );
        } catch (ClientException $e) {
            return new Response($e->getResponse()->getStatusCode(), null);
        }
            
        return new Response($response->getStatusCode(), $response->getBody()->getContents());
    }
    
    private function authenticatedAction(&$options)
    {
        if (!$this->token) {
            $response = $this->login()->getBody();
            $this->token = $response['token'];
            if (!$this->shopId) {
                $this->shopId = $response['default_shop_id'];
            }
        }
        $options['shopId'] = $this->shopId;
    }
    
    /**
     * @doc https://api-doc.wizishop.com/documentation/3/home#post--v3-auth-login
     * @param array $options
     * @return Http\Response
     */
    public function login()
    {
        $options = [
            'username' => $this->username,
            'password' => $this->password
        ];
        return $this->send(new LoginDefinition($options));
    }
    
    /**
     * @doc https://api-doc.wizishop.com/documentation/3/home#get--v3-shops--shopid-orders
     * @param array $options
     * @return Http\Response
     */
    public function getOrders(array $options = [])
    {
        $this->authenticatedAction($options);
        return $this->send(new GetOrdersDefinition($options));
    }
    
    /**
     * @doc https://api-doc.wizishop.com/documentation/3/home#get--v3-shops--shopid-orders--orderid
     * @param array $options
     * @return Http\Response
     */
    public function getOrder(array $options = [])
    {
        $this->authenticatedAction($options);
        return $this->send(new GetOrderDefinition($options));
    }
    
    /**
     * @doc https://api-doc.wizishop.com/documentation/3/home#get--v3-shops--shopid-customers
     * @param array $options
     * @return Http\Response
     */
    public function getCustomers(array $options = [])
    {
        $this->authenticatedAction($options);
        return $this->send(new GetCustomersDefinition($options));
    }
    
    /**
     * @doc https://api-doc.wizishop.com/documentation/3/home#get--v3-shops--shopid-customers--customerid
     * @param array $options
     * @return Http\Response
     */
    public function getCustomer(array $options = [])
    {
        $this->authenticatedAction($options);
        return $this->send(new GetCustomerDefinition($options));
    }
    
    /**
     * @doc https://api-doc.wizishop.com/documentation/3/home#get--v3-shops--shopid-newsletter-subscribers
     * @param array $options
     * @return Http\Response
     */
    public function getNewsletterSubscribers(array $options = [])
    {
        $this->authenticatedAction($options);
        return $this->send(new GetNewsletterSubscribersDefinition($options));
    }
}
