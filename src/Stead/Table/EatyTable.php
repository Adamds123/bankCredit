<?php
namespace App\Stead\Table;

use App\Stead\Entities\EatyEntity;
use Framework\Database\Query;
use Framework\Database\Table;

class EatyTable extends Table
{
    public string $table = 'menu';
    public $entity = EatyEntity::class;

    public function findPublic(): Query
    {
        return $this->findAll();
    }
}