<?php

namespace App\DTO;

use Illuminate\Http\UploadedFile;

class CreatePostDTO
{
    public string $title;
    public string $content;
    public int $user_id;
    public ?UploadedFile $image;

    public function __construct(string $title, string $content, int $user_id, ?UploadedFile $image = null)
    {
        $this->title = $title;
        $this->content = $content;
        $this->user_id = $user_id;
        $this->image = $image;
    }
}