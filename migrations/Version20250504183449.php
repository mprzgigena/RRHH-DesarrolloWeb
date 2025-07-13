<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250504183449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE empleado DROP FOREIGN KEY FK_D9D9BF52952BE730
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_D9D9BF52952BE730 ON empleado
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE empleado DROP empleado_id
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE empleado ADD empleado_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE empleado ADD CONSTRAINT FK_D9D9BF52952BE730 FOREIGN KEY (empleado_id) REFERENCES empleado (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_D9D9BF52952BE730 ON empleado (empleado_id)
        SQL);
    }
}
