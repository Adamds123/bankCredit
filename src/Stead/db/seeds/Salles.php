<?php


use Phinx\Seed\AbstractSeed;

class Salles extends AbstractSeed
{

    public function run()
    {
        $data = [];
        $faker = \Faker\Factory::create('fr_FR');
        for ($i=0; $i<3; $i++){
            $date = $faker->unixTime('now');
            $data[] = [
                'description' => $faker->sentence(10),
                'price' => rand(120,100),
                'occupied_on' => date('Y-m-d H:i:s', $date ),
                'image' => '',
                'released_on' => date('Y-m-d H:i:s', $date)
            ];
        }
        $this->table('salles')
            ->insert($data)
            ->save();
    }

}
