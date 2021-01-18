<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210118033110 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD wallet_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649712520F3 FOREIGN KEY (wallet_id) REFERENCES wallet (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649712520F3 ON user (wallet_id)');
        $this->addSql('ALTER TABLE wallet DROP FOREIGN KEY FK_7C68921F79F37AE5');
        $this->addSql('DROP INDEX UNIQ_7C68921F79F37AE5 ON wallet');
        $this->addSql('ALTER TABLE wallet DROP id_user_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649712520F3');
        $this->addSql('DROP INDEX UNIQ_8D93D649712520F3 ON user');
        $this->addSql('ALTER TABLE user DROP wallet_id');
        $this->addSql('ALTER TABLE wallet ADD id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE wallet ADD CONSTRAINT FK_7C68921F79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7C68921F79F37AE5 ON wallet (id_user_id)');
    }
}
