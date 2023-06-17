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

class DefaultValueMigrationOrderLG extends AbstractMigration implements MigrationInterface
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

        $result = $this->connection->executeQuery("SELECT COUNT(*) AS count FROM tl_content WHERE order_lg = -1");
        $row = $result->fetchAssociative();

        return ($row['count'] > 0);
    }

    public function run(): MigrationResult
    {
        // Führe hier deine Migrationsschritte durch
        $this->connection->executeUpdate("UPDATE tl_content SET order_lg = '' WHERE order_lg = -1");
        
        // Erstelle das Migrationsergebnis
        $result = $this->createResult(
            true,
            'Das Feld order_lg wurde erfolgreich aktualisiert.'
        );
        
        return $result;
    }

    public function getName(): string
    {
        return 'DefaultValueMigrationOrderLG';
    }
}
