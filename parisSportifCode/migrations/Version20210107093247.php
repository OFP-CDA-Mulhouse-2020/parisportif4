<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210107093247 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement_sport ADD CONSTRAINT FK_892F432AAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id)');
        $this->addSql('ALTER TABLE joueurs ADD CONSTRAINT FK_F0FD889DA3DC7281 FOREIGN KEY (joueurs_id) REFERENCES sport_individuel (id)');
        $this->addSql('ALTER TABLE joueurs ADD CONSTRAINT FK_F0FD889DC9D220D8 FOREIGN KEY (joueurs_equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE sport_individuel ADD CONSTRAINT FK_D0D7A60E8C35B4F2 FOREIGN KEY (sport_individuel_id) REFERENCES sport (id)');
        $this->addSql('ALTER TABLE wallet ADD credit INT NOT NULL, ADD add_money INT DEFAULT NULL, ADD withdraw_money INT DEFAULT NULL, ADD draw_bet INT DEFAULT NULL, ADD with_add_earnings INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement_sport DROP FOREIGN KEY FK_892F432AAC78BCF8');
        $this->addSql('ALTER TABLE joueurs DROP FOREIGN KEY FK_F0FD889DA3DC7281');
        $this->addSql('ALTER TABLE joueurs DROP FOREIGN KEY FK_F0FD889DC9D220D8');
        $this->addSql('ALTER TABLE sport_individuel DROP FOREIGN KEY FK_D0D7A60E8C35B4F2');
        $this->addSql('ALTER TABLE wallet DROP credit, DROP add_money, DROP withdraw_money, DROP draw_bet, DROP with_add_earnings');
    }
}
