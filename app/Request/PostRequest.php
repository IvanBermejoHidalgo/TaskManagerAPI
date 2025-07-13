<?php
namespace App\Request;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class PostRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/posts';
    }
}