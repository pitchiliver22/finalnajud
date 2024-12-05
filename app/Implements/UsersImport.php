<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\User;

class UsersImport implements ToModel
{
    public function model(array $row)
    {
        return new User([
            'firstname' => $row[0],  
            'lastname' => $row[1],   
            'middlename' => $row[2],  
            'suffix' => $row[3],      
            'role' => $row[4],        
            'email' => $row[5],       
            'password' => bcrypt($row[6]), 
        ]);
    }
}