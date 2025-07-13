<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use RuntimeException;
use App\Connectors\JsonPlaceHolderConnector;
use App\Request\PostRequest;
use App\DTOs\PostDTO;

class ExternalApiService {

    public function __construct(private readonly JsonPlaceHolderConnector $connector){

    }

    public function getPosts():array {

        try {

            $request = new PostRequest();
            $response = $this->connector->send($request);
            $data = $response->array();
            $results = [];
            foreach($data as $item){
                $results[] = PostDTO::fromApi($item)->toArray();
            }
            return $results;

        } catch (\Exception $e){
            throw new RuntimeException("Failed to show task: " . $e->getMessage(), 500);
        }
        
    }

}