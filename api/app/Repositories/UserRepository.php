<?php 

declare(strict_types = 1);

namespace App\Repositories;

use App\Exceptions\NoUserException;
use App\Models\User;
use App\Services\PasswordService;
use Illuminate\Database\Eloquent\Collection;

class UserRepository {
    
    protected User $model;
    protected PasswordService $passwordService;
   
    public function __construct(User $user, PasswordService $passwordService)
    {
        $this->model = $user;
        $this->passwordService =$passwordService;
    }
   
    public function getAllUsers(): Collection
    {
        return $this->model->withTrashed()->get();
    }
   
    public function getUserById(int $id): User 
    {
        $user = $this->model->find($id);
        if($user === NULL) {
            throw new NoUserException('There is no user with id '. $id);
        }
        
        return $user;
    }
   
    public function createUser(array $data):void
    {
        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $this->passwordService->hashPassword($data['password'])
        ]);
        $user->save();
    }
   
    public function updateUser(int $id, array $data):void 
    {
        $user = $this->getUserById($id); 
        
        if(isset($data['name'])) {
            $user->name = $data['name'];
        }
        if(isset($data['email'])) {
            $user->email = $data['email'];
        }
        if(isset($data['name'])) {
            $user->name = $data['name'];
        }
        if(isset($data['password'])) {
            $user->password = $this->passwordService->hashPassword($data['password']);
        }
        $user->save();
    }
    
    public function deleteUser(int $id): void
    {
        $user = $this->getUserById($id);
        $user->delete();
        $user->save();
    }
}
