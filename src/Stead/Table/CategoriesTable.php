<?php

namespace App\Stead\Table;

use App\Stead\Entities\CategoriesEntity;
use Framework\Database\Table;

class CategoriesTable extends Table
{
    public string $table = 'categories';
    public $entity = CategoriesEntity::class;

}