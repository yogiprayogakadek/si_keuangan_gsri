<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['username', 'password', 'role', 'is_active'];
    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    // protected $updatedField     = 'updated_at';

    protected $validationRules = [
        'username'  => 'required',
        'password'  => 'required|min_length[8]',
    ];

    protected $validationMessages = [
        'username' => [
            'required'  => 'Mohon masukan username anda'
        ]
    ];
}
