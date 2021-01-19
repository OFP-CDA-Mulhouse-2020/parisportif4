<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210119035232 extends AbstractMigration
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
        $this->addSql('CREATE TABLE competition (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, start_at DATETIME NOT NULL, end_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_user (id INT AUTO_INCREMENT NOT NULL, document LONGBLOB NOT NULL, is_valid TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, sport_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_2449BA15AC78BCF8 (sport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe_evenement_sport (equipe_id INT NOT NULL, evenement_sport_id INT NOT NULL, INDEX IDX_118D42E06D861B89 (equipe_id), INDEX IDX_118D42E0231E2710 (evenement_sport_id), PRIMARY KEY(equipe_id, evenement_sport_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement_sport (id INT AUTO_INCREMENT NOT NULL, competition_id INT DEFAULT NULL, sport_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, begin_date DATETIME NOT NULL, event_place VARCHAR(255) NOT NULL, INDEX IDX_892F432A7B39D312 (competition_id), INDEX IDX_892F432AAC78BCF8 (sport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueurs (id INT AUTO_INCREMENT NOT NULL, equipe_id INT DEFAULT NULL, sport_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_F0FD889D6D861B89 (equipe_id), INDEX IDX_F0FD889DAC78BCF8 (sport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sport (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, nb_teams INT NOT NULL, nb_players INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, wallet_id INT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, birth_date DATETIME NOT NULL, street VARCHAR(255) NOT NULL, street_number VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(5) NOT NULL, city VARCHAR(180) NOT NULL, phone VARCHAR(255) NOT NULL, create_date DATETIME NOT NULL, user_validation TINYINT(1) NOT NULL, user_validation_date DATETIME DEFAULT NULL, user_suspended TINYINT(1) NOT NULL, user_suspended_date DATETIME DEFAULT NULL, user_deleted TINYINT(1) NOT NULL, user_deleted_date DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649444F97DD (phone), UNIQUE INDEX UNIQ_8D93D649712520F3 (wallet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wallet (id INT AUTO_INCREMENT NOT NULL, credit INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15AC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id)');
        $this->addSql('ALTER TABLE equipe_evenement_sport ADD CONSTRAINT FK_118D42E06D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe_evenement_sport ADD CONSTRAINT FK_118D42E0231E2710 FOREIGN KEY (evenement_sport_id) REFERENCES evenement_sport (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_sport ADD CONSTRAINT FK_892F432A7B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id)');
        $this->addSql('ALTER TABLE evenement_sport ADD CONSTRAINT FK_892F432AAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id)');
        $this->addSql('ALTER TABLE joueurs ADD CONSTRAINT FK_F0FD889D6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE joueurs ADD CONSTRAINT FK_F0FD889DAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649712520F3 FOREIGN KEY (wallet_id) REFERENCES wallet (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement_sport DROP FOREIGN KEY FK_892F432A7B39D312');
        $this->addSql('ALTER TABLE equipe_evenement_sport DROP FOREIGN KEY FK_118D42E06D861B89');
        $this->addSql('ALTER TABLE joueurs DROP FOREIGN KEY FK_F0FD889D6D861B89');
        $this->addSql('ALTER TABLE equipe_evenement_sport DROP FOREIGN KEY FK_118D42E0231E2710');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15AC78BCF8');
        $this->addSql('ALTER TABLE evenement_sport DROP FOREIGN KEY FK_892F432AAC78BCF8');
        $this->addSql('ALTER TABLE joueurs DROP FOREIGN KEY FK_F0FD889DAC78BCF8');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649712520F3');
        $this->addSql('DROP TABLE bet');
        $this->addSql('DROP TABLE bet_user');
        $this->addSql('DROP TABLE competition');
        $this->addSql('DROP TABLE document_user');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE equipe_evenement_sport');
        $this->addSql('DROP TABLE evenement_sport');
        $this->addSql('DROP TABLE joueurs');
        $this->addSql('DROP TABLE sport');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE wallet');
    }
}
