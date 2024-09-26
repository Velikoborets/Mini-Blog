<?php

namespace App\DTO;

use Illuminate\Http\UploadedFile;

class UpdatePostDTO
{
    public string $title;
    public string $content;
    public ?UploadedFile $image;

    public function __construct(string $title, string $content, ?UploadedFile $image = null)
    {
        $this->title = $title;
        $this->content = $content;
        $this->image = $image;
    }
}