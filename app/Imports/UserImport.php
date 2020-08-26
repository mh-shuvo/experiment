<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UserImport implements ToCollection,WithValidation,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
           'name'     => $row['name'],
           'email'    => $row['email'], 
           'password' => Hash::make($row['password']),
        ]);
    }
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            User::create([
                'name'     => $row['name'],
                'email'    => $row['email'], 
                'password' => Hash::make($row['password']),
            ]);
        }
    }
    public function rules(): array
    {
        return [
            '*.name' => 'required',
            '*.email' => 'required|unique:users',
            '*.password' => 'required',
        ];
    }
}
