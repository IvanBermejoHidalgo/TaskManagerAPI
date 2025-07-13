<?php
namespace App\Connectors;
use Saloon\Http\Connector;

class JsonPlaceHolderConnector extends Connector
{
    public function resolveBaseUrl(): string
    {
        return 'https://jsonplaceholder.typicode.com';
    }
}