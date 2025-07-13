<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use RuntimeException;
use App\Connectors\JsonPlaceHolderConnector;
use App\Request\PostRequest;
use App\DTOs\PostDTO;

/**
 * Service responsible for interacting with external APIs.
*/
class ExternalApiService {

    /**
     * Constructor that injects the JSONPlaceholder connector.
     *
     * @param JsonPlaceHolderConnector $connector
    */
    public function __construct(private readonly JsonPlaceHolderConnector $connector){

    }

    /**
     * Retrieves posts from an external API and transforms them into DTOs.
     *
     * @return array An array of post data in array format.
     * @throws \RuntimeException If the request fails or the response is invalid.
    */

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