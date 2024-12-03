<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\User;

class UsersImport implements ToModel
{
    public function model(array $row)
    {
        return new User([
            'firstname' => $row[0],  // Adjust based on your Excel structure
            'lastname' => $row[1],   // Adjust based on your Excel structure
            'middlename' => $row[2],  // Adjust based on your Excel structure
            'suffix' => $row[3],      // Adjust based on your Excel structure
            'role' => $row[4],        // Adjust based on your Excel structure
            'email' => $row[5],       // Adjust based on your Excel structure
            'password' => bcrypt($row[6]), // Adjust based on your Excel structure
        ]);
    }
}