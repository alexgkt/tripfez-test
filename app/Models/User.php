<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * Check if provided password match hashed password
     * 
     * @param string $password
     * @return boolean
     */
    public function validatePassword ($password) {
        return password_verify($password, $this->password);
    }
}