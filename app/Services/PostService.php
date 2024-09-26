<?php

namespace App\Services;

use App\DTO\CreatePostDTO;
use App\DTO\UpdatePostDTO;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function create(CreatePostDTO $data): Post
    {
        $imageName = null;

        if ($data->image) {
            $imageName = time() . '.' . $data->image->extension();
            $data->image->move(public_path('images'), $imageName);
        }

        return Post::create([
            'title' => $data->title,
            'content' => $data->content,
            'user_id' => $data->user_id,
            'image' => $imageName
        ]);
    }

	public function update(Post $post, UpdatePostDTO $data): bool
    {
        $updateData = [
            'title' => $data->title,
            'content' => $data->content
        ];

        if ($data->image) { 		
            if ($post->image) {
                $oldImagePath = public_path('images/' . $post->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageName = time() . '.' . $data->image->extension();
            $data->image->move(public_path('images'), $imageName);
			
            $updateData['image'] = $imageName;
        }
        return $post->update($updateData);
    }

    public function delete(Post $post): ?bool
    {
        if ($post->image) {
            $imagePath = public_path('images/' . $post->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        return $post->delete();
    }

    public function getAll()
    {
        return Post::with('user')->get();
    }

    public function getById($id)
    {
        return Post::with('user')->findOrFail($id); 
    }
}