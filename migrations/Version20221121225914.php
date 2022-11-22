<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221121225914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, userid_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, f_name VARCHAR(255) NOT NULL, l_name VARCHAR(255) NOT NULL, cin VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, phone1 VARCHAR(255) DEFAULT NULL, phone2 VARCHAR(255) DEFAULT NULL, birthdate DATETIME NOT NULL, adress VARCHAR(255) DEFAULT NULL, commerce VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, expired_at DATETIME NOT NULL, images VARCHAR(255) DEFAULT NULL, revenu_salary DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX UNIQ_C744045558E0A285 (userid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique (id INT AUTO_INCREMENT NOT NULL, performance_id INT NOT NULL, operation VARCHAR(255) NOT NULL, date DATE NOT NULL, rem_acquis INT NOT NULL, rem_consommees INT NOT NULL, INDEX IDX_EDBFD5ECB91ADEEE (performance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orbit (id INT AUTO_INCREMENT NOT NULL, fils_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, generation INT NOT NULL, number INT NOT NULL, INDEX IDX_B4720513E6B9712F (fils_id), INDEX IDX_B4720513727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performance (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, price_gns_id INT DEFAULT NULL, rem_monthly INT DEFAULT NULL, rem_total INT NOT NULL, sold_solvable INT NOT NULL, sold_biens INT NOT NULL, UNIQUE INDEX UNIQ_82D7968119EB6921 (client_id), INDEX IDX_82D796812F22EC6D (price_gns_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE price_gn (id INT AUTO_INCREMENT NOT NULL, generation INT NOT NULL, price INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, fullname VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, img VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045558E0A285 FOREIGN KEY (userid_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5ECB91ADEEE FOREIGN KEY (performance_id) REFERENCES performance (id)');
        $this->addSql('ALTER TABLE orbit ADD CONSTRAINT FK_B4720513E6B9712F FOREIGN KEY (fils_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE orbit ADD CONSTRAINT FK_B4720513727ACA70 FOREIGN KEY (parent_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D7968119EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D796812F22EC6D FOREIGN KEY (price_gns_id) REFERENCES price_gn (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orbit DROP FOREIGN KEY FK_B4720513E6B9712F');
        $this->addSql('ALTER TABLE orbit DROP FOREIGN KEY FK_B4720513727ACA70');
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D7968119EB6921');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECB91ADEEE');
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D796812F22EC6D');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045558E0A285');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE historique');
        $this->addSql('DROP TABLE orbit');
        $this->addSql('DROP TABLE performance');
        $this->addSql('DROP TABLE price_gn');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE users');
    }
}
