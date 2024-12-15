<?php

namespace App\Imports;

use App\Models\address;
use App\Models\previous_school;
use App\Models\register_form;
use App\Models\studentdetails;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToCollection, ToModel
{
    private $current = 0;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // dd($collection);
    }

    public function model(array $row)
    {
        $this->current++;
    
        if ($this->current > 1) {
            if (count($row) >= 37) {
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
            
                if($user->save())
                {
                    $registerForm = new register_form();
                    $registerForm->user_id = $user->id;
                    $registerForm->firstname = $user->firstname;
                    $registerForm->middlename = $user->middlename;
                    $registerForm->lastname = $user->lastname;
                    $registerForm->suffix = $user->suffix;
                    $registerForm->email = $user->email;
                    $registerForm->password = $user->password;
                    $registerForm->status = 'approved';
                
                    $registerForm->save();
                    
                    //Student Details
                    $studentDetails = new studentdetails();
                    $studentDetails->details_id = $registerForm->id;
                    $studentDetails->firstname = $user->firstname;
                    $studentDetails->middlename = $user->middlename;
                    $studentDetails->lastname = $user->lastname;
                    $studentDetails->suffix = $user->suffix;
                    $studentDetails->nationality = trim($row[7] ?? ''); 
                    $studentDetails->gender = trim($row[8] ?? ''); 
                    $studentDetails->civilstatus = trim($row[9] ?? ''); 
                    $studentDetails->birthdate = date('Y-m-d', \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[10])->getTimestamp());
                    $studentDetails->birthplace = trim($row[11] ?? ''); 
                    $studentDetails->religion = trim($row[12] ?? ''); 
                    $studentDetails->mother_name = trim($row[13] ?? ''); 
                    $studentDetails->mother_occupation = trim($row[14] ?? ''); 
                    $studentDetails->mother_contact = (string) trim($row[15]); 
                    $studentDetails->father_name = trim($row[16] ?? ''); 
                    $studentDetails->father_occupation = trim($row[17] ?? ''); 
                    $studentDetails->father_contact = (string) trim($row[18]); 
                    $studentDetails->guardian_name = trim($row[19] ?? ''); 
                    $studentDetails->guardian_occupation = trim($row[20] ?? ''); 
                    $studentDetails->guardian_contact = (string) trim($row[21]); 
                    $studentDetails->status = 'pending';

                    $studentDetails->save();


                    //Address
                    $address = new address();
                    $address->address_id = $registerForm->id; 
                    $address->zipcode = $row[22]; 
                    $address->province = $row[23];
                    $address->city = $row[24];
                    $address->barangay = $row[25];
                    $address->streetaddress = $row[26];
                    $address->status = 'pending';

                    $address->save();


                    //Previous school
                    $previous = new previous_school();
                    $previous->school_id = $registerForm->id;
                    //secondary
                    $previous->second_school_name = $row[27];
                    $previous->second_last_year_level = $row[28];
                    $previous->second_school_year_from = $row[29];
                    $previous->second_school_year_to = $row[30];
                    $previous->second_school_type = $row[31];

                    //primary
                    $previous->primary_school_name = $row[32];
                    $previous->primary_last_year_level = $row[33];
                    $previous->primary_school_year_from = $row[34];
                    $previous->primary_school_year_to = $row[35];
                    $previous->primary_school_type = $row[36];
                    $previous->status = 'pending';

                    $previous->save();

                }//user save

            }
        }
    }

}
