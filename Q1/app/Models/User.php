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

    /**
     * Set hashed password
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = password_hash($value, PASSWORD_DEFAULT);
    }
}