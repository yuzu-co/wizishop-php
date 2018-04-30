<?php

require_once __DIR__.'/../vendor/autoload.php';

use Yuzu\Wizishop\Client;

$username = "####";
$password = "####";

$client = new Client($username, $password);

$results = $client->getOrders();
// var_dump($results);

$results = $client->getOrder(['orderId' => 9]);
// var_dump($results);

$results = $client->getCustomers();
// var_dump($results);

$results = $client->getCustomer(['customerId' => 5]);
// var_dump($results);

$results = $client->getNewsletterSubscribers();
// var_dump($results);
