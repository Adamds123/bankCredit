<?php


use Phinx\Seed\AbstractSeed;

final class RommsSeed extends AbstractSeed
{

    public function run(): void
    {
        $data = [];
        $faker = \Faker\Factory::create('fr_FR');
        for ($i=0; $i<50; $i++){
            $date = $faker->unixTime('now');
            $data[] = [
                'name' => 'chambre',
                'description' => $faker->sentence(10),
                'type' => array_rand(['Moyen', 'Cadre']),
                'statut' => false,
                'price' => rand(120,100),
                'occupied_on' => date('Y-m-d H:i:s', $date ),
                'released_on' => date('Y-m-d H:i:s', $date)
            ];
        }
        $this->table('Rooms')
            ->insert($data)
            ->save();
    }
}
