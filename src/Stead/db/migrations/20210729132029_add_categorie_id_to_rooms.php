<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddCategorieIdToRooms extends AbstractMigration
{
    public function change(): void
    {
        $this->table('Rooms')
            ->addColumn('category_id','integer', ['null'=>true])
            ->addForeignKey('category_id', 'categoriesEntity','id', [
                'delete' => 'SET NULL'
            ])
        ->update();
    }
}
