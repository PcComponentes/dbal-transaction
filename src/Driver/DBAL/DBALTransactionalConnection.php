<?php
declare(strict_types=1);

namespace PcComponentes\Transaction\Driver\DBAL;

use Doctrine\DBAL\Connection;
use PcComponentes\Transaction\Driver\TransactionalConnection;

final class DBALTransactionalConnection implements TransactionalConnection
{
    private Connection $DBALConnection;

    public function __construct(Connection $DBALConnection)
    {
        $this->DBALConnection = $DBALConnection;
    }

    public function beginTransaction(): void
    {
        $this->DBALConnection->beginTransaction();
    }

    public function commit(): void
    {
        $this->DBALConnection->commit();
    }

    public function rollBack(): void
    {
        $this->DBALConnection->rollBack();
    }

    public function isTransactionActive(): bool
    {
        return $this->DBALConnection->isTransactionActive();
    }
}
