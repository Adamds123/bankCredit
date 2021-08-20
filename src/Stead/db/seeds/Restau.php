<?php


use Phinx\Seed\AbstractSeed;

class Restau extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $data = [];
        $faker = \Faker\Factory::create('fr_FR');
        for ($i=0; $i<5; $i++){
            $date = $faker->unixTime('now');
            $data[] = [
                'description' => $faker->sentence(10),
                'image' => '',
                'price' => rand(120,100)
            ];
        }
        $this->table('menu')
            ->insert($data)
            ->save();
    }
}
