<?php

declare(strict_types=1);

/*
 * This file is part of Schuldnerberatung.
 *
 * (c) Christian Romeni 2022 <christian@romeni.eu>
 * @license MIT
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/rwd/contao-sb-bundle
 */

namespace Rwd\ContaoCustomArticlesBundle\Migration;

// use Contao\CoreBundle\Migration\AbstractMigration;
// use Contao\CoreBundle\Migration\MigrationResult;

use Contao\CoreBundle\Migration\MigrationInterface;
use Contao\CoreBundle\Migration\AbstractMigration;
use Contao\CoreBundle\Migration\MigrationResult;
use Doctrine\DBAL\Connection;

class GridXLToContentXL extends AbstractMigration implements MigrationInterface
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function shouldRun(): bool
    {
        // Überprüfe hier deine Bedingungen
        $schemaManager = $this->connection->getSchemaManager();
        if (!$schemaManager->tablesExist(['tl_content'])) {
            return false;
        }

        $columns = $schemaManager->listTableColumns('tl_content');

        return 
	        isset($columns['grid_xl']) &&
	        !isset($columns['size_xl']);
    }

    public function run(): MigrationResult
    {
        // Führe hier deine Migrationsschritte durch
        $this->connection->executeUpdate("ALTER TABLE tl_content CHANGE grid_xl size_xl varchar(2)");
        
        // Erstelle das Migrationsergebnis
        $result = $this->createResult(
            true,
            'The Column grid_xl was renamed to size_xl.'
        );
        
        return $result;
    }

    public function getName(): string
    {
        return 'GridXLToContentXL';
    }
}
