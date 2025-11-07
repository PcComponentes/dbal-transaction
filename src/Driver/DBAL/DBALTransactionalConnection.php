<?php
declare(strict_types=1);

namespace PcComponentes\Transaction\Driver\DBAL;

use Doctrine\DBAL\Connection;
use PcComponentes\Transaction\Driver\TransactionalConnection;

final class DBALTransactionalConnection implements TransactionalConnection
{
    private Connection $DBALConnection;

    public function __construct(Connection $DBALConnection, bool $nestTransactionsWithSavepoints = false)
    {
        $this->DBALConnection = $DBALConnection;

        if (true === $nestTransactionsWithSavepoints) {
            // In DBAL 4+, savepoints are always enabled for nested transactions
            // The setNestTransactionsWithSavepoints method is deprecated and will be removed in DBAL 5
            // We only call it if it exists to maintain backward compatibility with DBAL 2.x and 3.x
            if (\method_exists($this->DBALConnection, 'setNestTransactionsWithSavepoints')) {
                @$this->DBALConnection->setNestTransactionsWithSavepoints(true);
            }
        }
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
