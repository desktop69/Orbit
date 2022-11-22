<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220301230541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE historique (id INT AUTO_INCREMENT NOT NULL, performance_id INT NOT NULL, operation VARCHAR(255) NOT NULL, date DATE NOT NULL, rem_acquis INT NOT NULL, rem_consommees INT NOT NULL, INDEX IDX_EDBFD5ECB91ADEEE (performance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performance (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, price_gns_id INT DEFAULT NULL, rem_monthly INT DEFAULT NULL, rem_total INT NOT NULL, sold_solvable INT NOT NULL, sold_biens INT NOT NULL, UNIQUE INDEX UNIQ_82D7968119EB6921 (client_id), INDEX IDX_82D796812F22EC6D (price_gns_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5ECB91ADEEE FOREIGN KEY (performance_id) REFERENCES performance (id)');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D7968119EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D796812F22EC6D FOREIGN KEY (price_gns_id) REFERENCES price_gn (id)');
        $this->addSql('ALTER TABLE client DROP id_client');
        $this->addSql('ALTER TABLE users CHANGE img img VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECB91ADEEE');
        $this->addSql('DROP TABLE historique');
        $this->addSql('DROP TABLE performance');
        $this->addSql('ALTER TABLE client ADD id_client INT DEFAULT NULL, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE f_name f_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE l_name l_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cin cin VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone1 phone1 VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone2 phone2 VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adress adress VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE commerce commerce VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE reset_password_request CHANGE selector selector VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE hashed_token hashed_token VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE users CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE fullname fullname VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone phone VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE img img VARCHAR(255) DEFAULT \'https://bootdey.com/img/Content/avatar/avatar7.png\' COLLATE `utf8mb4_unicode_ci`');
    }
}
