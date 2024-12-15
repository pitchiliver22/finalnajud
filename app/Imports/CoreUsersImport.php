<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;


class CoreUsersImport implements ToCollection, ToModel
{
    private $current = 0;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
    }

    public function model(array $row)
    {
        $this->current++;
    
        if ($this->current > 1) {
            if (count($row) >= 7) {
                if (empty($row[0])) {
                    return; 
                }
    
                $user = new User;
                $user->firstname = $row[0] ?? null;
                $user->middlename = $row[1] ?? null;
                $user->lastname = $row[2] ?? null;
                $user->suffix = $row[3] ?? null;
                $user->role = $row[4] ?? null;
                $user->email = $row[5] ?? null;
                $user->password = Hash::make($row[6] ?? null);
                
                $user->save();
            }
        }
    }
}
