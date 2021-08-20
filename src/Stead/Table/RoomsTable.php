<?php
namespace App\Stead\Table;

use App\Stead\Entities\RoomEntity;
use Framework\Database\Query;
use Framework\Database\Table;

class RoomsTable extends Table
{
    public string $table = 'salles';
    public $entity = RoomEntity::class;

    public function findAll(): Query
    {
        $category = new categoriesTable($this->pdo);
        return $this->makeQuery()
            ->join( 'users as u', 'u.id = r.user_id')
            ->select('r.*,u.username,u.lastName')
            ->order('r.id ASC');
    }
    public function findPublic(): Query
    {
        return $this->findAll()
            ->where('r.released_on < NOW()');
    }

}