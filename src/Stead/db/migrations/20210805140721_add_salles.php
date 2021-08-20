<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddSalles extends AbstractMigration
{
    public function change(): void
    {
        $this->table('salles')
            ->addColumn('price', 'integer')
            ->addColumn('description', 'string')
            ->addColumn('occupied_on', 'datetime')
            ->addColumn('released_on', 'datetime')
            ->addColumn('image', 'string')
            ->create();
    }
}
