<?php

namespace App\Imports;

use App\Models\Direcciones;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $user =  new User([
        //     'name' => $row["nombre"],
        //     'email' => $row["correo"],
        //     'password' => $row["pass"]
        // ]);
        $user =  new Direcciones([
            'user_id' => $row["user_id"],
            'domicilio' => $row["dir"],
            'condomino' => $row["condomino"]
        ]);

        // $user->assignRole('Vecino');

        return $user;
    }
}
