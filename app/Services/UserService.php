<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function usersIndex()
    {
        return User::orderBy('name')->get();
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function storeUser(array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        return User::create($data);
    }


    public function updateUser($id, array $data)
    {
        $user = $this->getUserById($id);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return $user;
    }


    public function deleteUser($id)
    {
        $user = $this->getUserById($id);
        return $user->delete();
    }
}
