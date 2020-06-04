<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200604094816 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE departments ADD employees_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE departments ADD CONSTRAINT FK_16AEB8D48520A30B FOREIGN KEY (employees_id) REFERENCES employees (id)');
        $this->addSql('CREATE INDEX IDX_16AEB8D48520A30B ON departments (employees_id)');
        $this->addSql('ALTER TABLE salaries CHANGE emp_id_id emp_id_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE departments DROP FOREIGN KEY FK_16AEB8D48520A30B');
        $this->addSql('DROP INDEX IDX_16AEB8D48520A30B ON departments');
        $this->addSql('ALTER TABLE departments DROP employees_id');
        $this->addSql('ALTER TABLE salaries CHANGE emp_id_id emp_id_id INT DEFAULT NULL');
    }
}
