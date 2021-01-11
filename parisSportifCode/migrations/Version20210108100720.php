<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210108100720 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bet (id INT AUTO_INCREMENT NOT NULL, name_bet VARCHAR(255) NOT NULL, cote INT NOT NULL, create_date DATETIME NOT NULL, result_bet TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bet_user (id INT AUTO_INCREMENT NOT NULL, amount_bet_date DATETIME NOT NULL, amount_bet INT NOT NULL, status_bet TINYINT(1) DEFAULT NULL, earnings INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_user (id INT AUTO_INCREMENT NOT NULL, document LONGBLOB NOT NULL, is_valid TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement_sport (id INT AUTO_INCREMENT NOT NULL, sport_id INT NOT NULL, name VARCHAR(255) NOT NULL, begin_date DATETIME NOT NULL, event_place VARCHAR(255) NOT NULL, INDEX IDX_892F432AAC78BCF8 (sport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueurs (id INT AUTO_INCREMENT NOT NULL, joueurs_id INT NOT NULL, joueurs_equipe_id INT NOT NULL, name VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_F0FD889DA3DC7281 (joueurs_id), INDEX IDX_F0FD889DC9D220D8 (joueurs_equipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sport (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sport_collectif (id INT AUTO_INCREMENT NOT NULL, nombre_joueurs INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sport_individuel (id INT AUTO_INCREMENT NOT NULL, sport_individuel_id INT NOT NULL, INDEX IDX_D0D7A60E8C35B4F2 (sport_individuel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, birth_date DATETIME NOT NULL, street VARCHAR(255) NOT NULL, street_number VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(5) NOT NULL, city VARCHAR(180) NOT NULL, phone VARCHAR(255) NOT NULL, create_date DATETIME NOT NULL, user_validation TINYINT(1) NOT NULL, user_validation_date DATETIME DEFAULT NULL, user_suspended TINYINT(1) NOT NULL, user_suspended_date DATETIME DEFAULT NULL, user_deleted TINYINT(1) NOT NULL, user_deleted_date DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649444F97DD (phone), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wallet (id INT AUTO_INCREMENT NOT NULL, credit INT NOT NULL, add_money INT DEFAULT NULL, withdraw_money INT DEFAULT NULL, draw_bet INT DEFAULT NULL, with_add_earnings INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evenement_sport ADD CONSTRAINT FK_892F432AAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id)');
        $this->addSql('ALTER TABLE joueurs ADD CONSTRAINT FK_F0FD889DA3DC7281 FOREIGN KEY (joueurs_id) REFERENCES sport_individuel (id)');
        $this->addSql('ALTER TABLE joueurs ADD CONSTRAINT FK_F0FD889DC9D220D8 FOREIGN KEY (joueurs_equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE sport_individuel ADD CONSTRAINT FK_D0D7A60E8C35B4F2 FOREIGN KEY (sport_individuel_id) REFERENCES sport (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE joueurs DROP FOREIGN KEY FK_F0FD889DC9D220D8');
        $this->addSql('ALTER TABLE evenement_sport DROP FOREIGN KEY FK_892F432AAC78BCF8');
        $this->addSql('ALTER TABLE sport_individuel DROP FOREIGN KEY FK_D0D7A60E8C35B4F2');
        $this->addSql('ALTER TABLE joueurs DROP FOREIGN KEY FK_F0FD889DA3DC7281');
        $this->addSql('DROP TABLE bet');
        $this->addSql('DROP TABLE bet_user');
        $this->addSql('DROP TABLE document_user');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE evenement_sport');
        $this->addSql('DROP TABLE joueurs');
        $this->addSql('DROP TABLE sport');
        $this->addSql('DROP TABLE sport_collectif');
        $this->addSql('DROP TABLE sport_individuel');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE wallet');
    }
}
