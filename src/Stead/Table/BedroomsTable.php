<?php

namespace App\Stead\Table;

use App\Stead\Entities\BedroomEntity;
use Framework\Database\Query;
use Framework\Database\Table;


class BedroomsTable extends Table
{
    public string $table = 'Rooms';
    public $entity = BedroomEntity::class;

    public function findAll(): Query
    {
        $category = new categoriesTable($this->pdo);
        return $this->makeQuery()
            ->join($category->getTable() . ' as c', 'c.id = r.category_id')
            ->join( 'users as u', 'u.id = r.user_id')
            ->select('r.*,u.username,u.lastName, c.name as category_name, c.slug as category_slug')
            ->order('r.id ASC');
    }
    public function findPublic(): Query
    {
        return $this->findAll()
                ->where('r.released_on < NOW()');
    }

    public function findPublicForCategory(int $id): Query
    {
        return $this->findPublic()->where("r.category_id = $id");
    }

    public function findWithCategory(int $postId): bedroomEntity
    {
        return $this->findPublic()->where("r.id = $postId")->fetch();
    }

}