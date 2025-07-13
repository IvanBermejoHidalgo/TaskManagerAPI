<?php
namespace App\DTOs;

class PostDTO {
    private string $title;
    private string $description;

    public function __construct(string $title, string $description) {

        $this->title = $title;
        $this->description = $description;
    }

    public static function fromApi(array $data): self {

        return new self(title:data_get($data,"title"),description:data_get($data,"body"));
    }

    public function toArray() {

        return ["title"=>$this->title,"description"=>$this->description];
    }


}