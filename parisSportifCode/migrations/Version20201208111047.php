<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201208111047 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD user_validation TINYINT(1) NOT NULL, ADD user_validation_date DATETIME DEFAULT NULL, ADD user_suspended TINYINT(1) NOT NULL, ADD user_suspended_date DATETIME DEFAULT NULL, ADD user_deleted TINYINT(1) NOT NULL, ADD user_deleted_date DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP user_validation, DROP user_validation_date, DROP user_suspended, DROP user_suspended_date, DROP user_deleted, DROP user_deleted_date');
    }
}
