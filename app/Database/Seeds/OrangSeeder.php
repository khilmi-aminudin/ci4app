<?php namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class OrangSeeder extends \CodeIgniter\Database\Seeder
{
        public function run()
        {
                // $data = [
                //     [
                //         'nama'      => 'Khilmi',
                //         'alamat'    => 'Jalan 12345 halo',
                //         'created_at'=> Time::now(),
                //         'updated_at'=> Time::now()
                //     ],
                //     [
                //         'nama'      => 'Fathi',
                //         'alamat'    => 'RT 05 RW 06',
                //         'created_at'=> Time::now(),
                //         'updated_at'=> Time::now()
                //     ],
                //     [
                //         'nama'      => 'Faza',
                //         'alamat'    => 'Sikasur',
                //         'created_at'=> Time::now(),
                //         'updated_at'=> Time::now()
                //     ],
                //     [
                //         'nama'      => 'Mauzza',
                //         'alamat'    => 'Kucing',
                //         'created_at'=> Time::now(),
                //         'updated_at'=> Time::now()
                //     ],
                //     [
                //         'nama'      => 'Choky',
                //         'alamat'    => 'Oren',
                //         'created_at'=> Time::now(),
                //         'updated_at'=> Time::now()
                //     ],
                // ];

                
                $faker = \Faker\Factory::create('id_ID');
                $data = [
                    'nama'      => $faker->name,
                    'alamat'    => $faker->address,
                    'created_at'=> Time::createFromTimestamp($faker->unixTime()),
                    'updated_at'=> Time::createFromTimestamp($faker->unixTime())
                ];

                // Simple Queries
                // $this->db->query("INSERT INTO orang (nama, alamat, created_at, updated_at) VALUES(:nama:, :alamat:, :created_at:, :updated_at:)",
                //         $data
                // );

                // for ($i=0; $i < 100 ; $i++) {                 
                //         $this->db->table('orang')->insert($data);
                // }

                // // Using Query Builder
                // $this->db->table('orang')->insert($data);
                // $this->db->table('orang')->insertBatch($data);
        }
}