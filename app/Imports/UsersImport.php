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

        // para usuarios
        //     $user =  new User([
        //         'name' => $row["nombre"],
        //         'email' => $row["correo"],
        //         'password' => $row["pass"]
        //     ]);

        // $user->assignRole('Vecino');
        // fin usuarios


        // para direcciones 
        $user =  new Direcciones([
            'domicilio' => $row["dir"],
            'condomino' => $row["condomino"]
        ]);
        // $user =  new Direcciones([
        //     'domicilio' => $row["dir"],
        //     'condomino' => $row["condomino"]
        // ]);

        $user->save();
        $user->owner()->attach($row['user_id']);
        // fin direcciones
        

        return $user;
    }
}
