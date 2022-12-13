<?php
declare(strict_types = 1);

namespace App\Services;

use Illuminate\Support\Facades\Hash;

class PasswordService {
    
    public function hashPassword(string $password): string
    {
        return Hash::make($password);
    }
}
