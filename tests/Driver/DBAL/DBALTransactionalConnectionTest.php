<?php
declare(strict_types=1);

namespace PcComponentes\Transaction\Tests\Driver\DBAL;

use Doctrine\DBAL\Connection;
use PcComponentes\Transaction\Driver\DBAL\DBALTransactionalConnection;
use PHPUnit\Framework\TestCase;

final class DBALTransactionalConnectionTest extends TestCase
{
    /**
     * @test
     */
    public function given_dbal_connection_when_begin_transaction_then_it_is_done_in_dbal_connection()
    {
        $DBALConnection = $this->createMock(Connection::class);

        $DBALConnection
            ->expects($this->once())
            ->method('beginTransaction')
        ;

        $transactionalConnection = new DBALTransactionalConnection($DBALConnection);
        $transactionalConnection->beginTransaction();
    }

    /**
     * @test
     */
    public function given_dbal_connection_when_commit_then_it_is_done_in_dbal_connection()
    {
        $DBALConnection = $this->createMock(Connection::class);

        $DBALConnection
            ->expects($this->once())
            ->method('commit')
        ;

        $transactionalConnection = new DBALTransactionalConnection($DBALConnection);
        $transactionalConnection->commit();
    }

    /**
     * @test
     */
    public function given_dbal_connection_when_roll_back_then_it_is_done_in_dbal_connection()
    {
        $DBALConnection = $this->createMock(Connection::class);

        $DBALConnection
            ->expects($this->once())
            ->method('rollBack')
        ;

        $transactionalConnection = new DBALTransactionalConnection($DBALConnection);
        $transactionalConnection->rollBack();
    }

    /**
     * @test
     */
    public function given_dbal_connection_when_is_in_transaction_active_then_return_true()
    {
        $DBALConnection = $this->createMock(Connection::class);

        $DBALConnection
            ->expects($this->once())
            ->method('isTransactionActive')
            ->willReturn(true)
        ;

        $transactionalConnection = new DBALTransactionalConnection($DBALConnection);
        $this->assertTrue($transactionalConnection->isTransactionActive());
    }

    /**
     * @test
     */
    public function given_dbal_connection_when_is_not_in_transaction_active_then_return_false()
    {
        $DBALConnection = $this->createMock(Connection::class);

        $DBALConnection
            ->expects($this->once())
            ->method('isTransactionActive')
            ->willReturn(false)
        ;

        $transactionalConnection = new DBALTransactionalConnection($DBALConnection);
        $this->assertFalse($transactionalConnection->isTransactionActive());
    }
}
