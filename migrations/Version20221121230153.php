<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221121230153 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE historique (id INT AUTO_INCREMENT NOT NULL, performance_id INT NOT NULL, operation VARCHAR(255) NOT NULL, date DATE NOT NULL, rem_acquis INT NOT NULL, rem_consommees INT NOT NULL, INDEX IDX_EDBFD5ECB91ADEEE (performance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orbit (id INT AUTO_INCREMENT NOT NULL, fils_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, generation INT NOT NULL, number INT NOT NULL, INDEX IDX_B4720513E6B9712F (fils_id), INDEX IDX_B4720513727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performance (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, price_gns_id INT DEFAULT NULL, rem_monthly INT DEFAULT NULL, rem_total INT NOT NULL, sold_solvable INT NOT NULL, sold_biens INT NOT NULL, UNIQUE INDEX UNIQ_82D7968119EB6921 (client_id), INDEX IDX_82D796812F22EC6D (price_gns_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE price_gn (id INT AUTO_INCREMENT NOT NULL, generation INT NOT NULL, price INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5ECB91ADEEE FOREIGN KEY (performance_id) REFERENCES performance (id)');
        $this->addSql('ALTER TABLE orbit ADD CONSTRAINT FK_B4720513E6B9712F FOREIGN KEY (fils_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE orbit ADD CONSTRAINT FK_B4720513727ACA70 FOREIGN KEY (parent_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D7968119EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D796812F22EC6D FOREIGN KEY (price_gns_id) REFERENCES price_gn (id)');
        $this->addSql('ALTER TABLE client ADD images VARCHAR(255) DEFAULT NULL, ADD revenu_salary DOUBLE PRECISION DEFAULT NULL, DROP id_client, CHANGE birthdate birthdate DATETIME NOT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE expired_at expired_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE users ADD fullname VARCHAR(255) DEFAULT NULL, ADD phone VARCHAR(255) DEFAULT NULL, ADD img VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECB91ADEEE');
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D796812F22EC6D');
        $this->addSql('DROP TABLE historique');
        $this->addSql('DROP TABLE orbit');
        $this->addSql('DROP TABLE performance');
        $this->addSql('DROP TABLE price_gn');
        $this->addSql('ALTER TABLE client ADD id_client INT NOT NULL, DROP images, DROP revenu_salary, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE f_name f_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE l_name l_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cin cin VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone1 phone1 VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone2 phone2 VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE birthdate birthdate VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adress adress VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE commerce commerce VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE updated_at updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE expired_at expired_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE reset_password_request CHANGE selector selector VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE hashed_token hashed_token VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE users DROP fullname, DROP phone, DROP img, CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
