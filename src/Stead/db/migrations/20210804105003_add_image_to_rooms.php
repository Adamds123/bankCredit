<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddImageToRooms extends AbstractMigration
{

    public function change(): void
    {
        $this->table('Rooms')
            ->addColumn('image', 'string', ['null' => true])
            ->update();
    }
}
