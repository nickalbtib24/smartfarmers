<?php

use Illuminate\Database\Seeder;
use App\Role;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator=Role::create([
            'name' => 'Administrator',
            'slug' => 'administrator',
            'permissions' => json_encode([
                'crud' => true,
            ])
        ]);

        $compradorVendedor=Role::create([
            'name' => 'CompradorVendedor',
            'slug' => 'comprador-vendedor',
            'permissions' =>json_encode([
                'create-post' => true,
            ])
        ]);
    }
}
