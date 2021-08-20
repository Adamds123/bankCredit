<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CategoriyTable extends AbstractMigration
{

    public function change(): void
    {
        $this->table('categoriesEntity')
            ->addIndex('slug', ['unique' => true])
            ->update();
    }
}
