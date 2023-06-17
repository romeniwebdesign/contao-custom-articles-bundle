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

class GridMDToContentMD extends AbstractMigration implements MigrationInterface
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
	        isset($columns['grid_md']) &&
	        !isset($columns['size_md']);
    }

    public function run(): MigrationResult
    {
        // Führe hier deine Migrationsschritte durch
        $this->connection->executeUpdate("ALTER TABLE tl_content CHANGE grid_md size_md varchar(2)");
        
        // Erstelle das Migrationsergebnis
        $result = $this->createResult(
            true,
            'The Column grid_md was renamed to size_md.'
        );
        
        return $result;
    }

    public function getName(): string
    {
        return 'GridMDToContentMD';
    }
}
