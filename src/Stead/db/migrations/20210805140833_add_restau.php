<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddRestau extends AbstractMigration
{

    public function change(): void
    {
        $this->table('menu')
            ->addColumn('price', 'integer')
            ->addColumn('description', 'string')
            ->addColumn('image', 'string')
            ->create();
    }
}
