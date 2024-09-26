<?php

namespace App\Services;

use App\DTO\CreateUserDTO; 
use App\DTO\UpdateUserDTO;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function create(CreateUserDTO $data): User
    {
        return User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ]);
    }
	
    public function update(User $user, UpdateUserDTO $data): bool
    {
        return $user->update([
            'name' => $data->name,
            'email' => $data->email,
        ]);
    }
	
    public function delete(User $user): ?bool
    {
        return $user->delete();
    }
	
	public function getAll()
    {
        return User::all();
    }
	
	public function getById($id): User
    {
        return User::findOrFail($id);
    }
}