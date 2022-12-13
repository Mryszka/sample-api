<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Redis;

class CacheRepository {
    
    public function getCachedUser(int $id): ?User
    {
        return Redis::get($this->getKeyForUser($id));
    }
    
    public function setUserToCache(User $user): void
    {
        Redis::set($this->getKeyForUser($user->id), $user);
    }
    
    public function delUserFromCache(int $id): void
    {
        Redis::del($this->getKeyForUser($id));
    }
    
    protected function getKeyForUser(int $id): string
    {
        return 'user:profile:'.$id;
    }
}
