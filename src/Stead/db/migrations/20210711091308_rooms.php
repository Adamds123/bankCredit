<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Rooms extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $this->table('Rooms')
            ->addColumn('name', 'string')
            ->addColumn('description', 'string')
            ->addColumn('type', 'string')
            ->addColumn('statut', 'boolean')
            ->addColumn('price', 'integer')
            ->addColumn('occupied_on', 'datetime')
            ->addColumn('released_on', 'datetime')
            ->create();
    }
}
