<?php

namespace Database\Seeders;

use App\Models\MaestroAbility;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class MaestroAbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $maestros = User::query()->where('type', 'maestro')->get();
        foreach ($maestros as $maestro) {

            $rand_num = rand(0,4);
            $needed_abilities = Arr::random( MaestroAbility::$abilities_list ,$rand_num);

            foreach ($needed_abilities as $ability) {
                MaestroAbility::factory()->create(['maestro_id' => $maestro->id, 'ability' => $ability]);
            }

        }
    }
}
