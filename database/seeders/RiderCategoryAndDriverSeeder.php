<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\RaceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RiderCategoryAndDriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $riderCategories = [
            'Moto GP' => [
                'A. Espargaro',
                'F. Bagnaia',
                'B. Binder',
                'M. Oliveira',
                'M. Viñales',
                'J. Martin',
                'L. Marini',
                'J. Miller',
                'J. Zarco',
                'R. Fernandez',
                'A. Fernandez',
                'P. Espargaro',
                'F. Di Giannantonio',
                'F. Morbidelli',
                'F. Quartararo',
                'T. Nakagami',
                'I. Lecuona',
                'E. Bastianini',
                'M. Marquez',
                'A. Marquez',
                'M. Bezzecchi',
                'J. Mir',
                'J. Folger',
                'A.Rins',
                'D. Pedrosa'

            ],
            /* 'Moto 2' => [
                'F. Aldeguer',
                'A. Canet',
                'P. Acosta',
                'J. Roberts',
                'M. Gonzalez',
                'B. Baltus',
                'S. Lowes',
                'A. Ogura',
                'S. Chantra',
                'T. Arbolino',
                'J. Alcoba',
                'C. Vietti',
                'F. Salac',
                'A. Arenas',
                'D. Binder',
                'L. Tulovic',
                'B. Bendsneyder',
                'A. Escrig',
                'M. Ramirez',
                'Z. Van Den Goorbergh',
                'I. Guevara',
                'K. Nozane',
                'A. Lopez',
                'S. Garcia',
                'B. Gomez',
                'J. Dixon',
                'T. Hada',
                'D. Foggia',
                'R. Skinner'
            ],
            'Moto 3' => [
                'D. Alonso',
                'A. Sasaki',
                'D. Holgado',
                'I. Ortola',
                'D. Muñoz',
                'D. Salvador',
                'D. Moreira',
                'J. Rueda',
                'C. Veijer',
                'R. Fenati',
                'D. Öncü',
                'S. Nepa',
                'R. Rossi',
                'K. Toba',
                'R. Yamanaka',
                'J. Kelso',
                'S. Ogden',
                'J. Masia',
                'F. Farioli',
                'T. Furusato',
                'X. Artigas',
                'M. Suryo Aji',
                'A. Carrasco',
                'J. Whatley',
                'S. Azman',
                'T. Suzuki',
                'M. Bertelle',
                'L. Fellon'
            ] */
        ];
        foreach ($riderCategories as $riderCategory => $riders) {
            $category = RaceType::create([
                'race_name' => $riderCategory
            ]);

            foreach ($riders as $rider) {
                Driver::create([
                    'name' => $rider,
                    'race_type_id' => $category->id
                ]);
            }
        }
    }
}
