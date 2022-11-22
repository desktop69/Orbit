<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220215224002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orbit DROP FOREIGN KEY FK_B4720513E6B9712F');
        $this->addSql('ALTER TABLE orbit DROP FOREIGN KEY FK_B4720513727ACA70');
        $this->addSql('ALTER TABLE orbit ADD CONSTRAINT FK_B4720513E6B9712F FOREIGN KEY (fils_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE orbit ADD CONSTRAINT FK_B4720513727ACA70 FOREIGN KEY (parent_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE f_name f_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE l_name l_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cin cin VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone1 phone1 VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone2 phone2 VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adress adress VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE commerce commerce VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE orbit DROP FOREIGN KEY FK_B4720513E6B9712F');
        $this->addSql('ALTER TABLE orbit DROP FOREIGN KEY FK_B4720513727ACA70');
        $this->addSql('ALTER TABLE orbit ADD CONSTRAINT FK_B4720513E6B9712F FOREIGN KEY (fils_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE orbit ADD CONSTRAINT FK_B4720513727ACA70 FOREIGN KEY (parent_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE reset_password_request CHANGE selector selector VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE hashed_token hashed_token VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE users CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE fullname fullname VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone phone VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE img img VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}