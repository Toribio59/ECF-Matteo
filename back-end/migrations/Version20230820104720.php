<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230820104720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(50) NOT NULL, price INT NOT NULL, manufacture_year INT NOT NULL, mileage DOUBLE PRECISION NOT NULL, description VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, brand VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedule (id INT AUTO_INCREMENT NOT NULL, monday_otm VARCHAR(5) DEFAULT NULL, monday_ctm VARCHAR(5) DEFAULT NULL, monday_ota VARCHAR(5) DEFAULT NULL, monday_cta VARCHAR(5) DEFAULT NULL, tuesday_otm VARCHAR(5) DEFAULT NULL, tuesday_ctm VARCHAR(5) DEFAULT NULL, tuesday_ota VARCHAR(5) DEFAULT NULL, tuesday_cta VARCHAR(5) DEFAULT NULL, wednesday_otm VARCHAR(5) DEFAULT NULL, wednesday_ctm VARCHAR(5) DEFAULT NULL, wednesday_ota VARCHAR(5) DEFAULT NULL, wednesday_cta VARCHAR(5) DEFAULT NULL, thursday_otm VARCHAR(5) DEFAULT NULL, thursday_ctm VARCHAR(5) DEFAULT NULL, thursday_ota VARCHAR(5) DEFAULT NULL, thursday_cta VARCHAR(5) DEFAULT NULL, friday_otm VARCHAR(5) DEFAULT NULL, friday_ctm VARCHAR(5) DEFAULT NULL, friday_ota VARCHAR(5) DEFAULT NULL, friday_cta VARCHAR(5) DEFAULT NULL, saturday_otm VARCHAR(5) DEFAULT NULL, saturday_ctm VARCHAR(5) DEFAULT NULL, saturday_ota VARCHAR(5) DEFAULT NULL, saturday_cta VARCHAR(5) DEFAULT NULL, sunday_otm VARCHAR(5) DEFAULT NULL, sunday_ctm VARCHAR(5) DEFAULT NULL, sunday_ota VARCHAR(5) DEFAULT NULL, sunday_cta VARCHAR(5) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(50) NOT NULL, description VARCHAR(255) NOT NULL, tag VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testimonial (id INT AUTO_INCREMENT NOT NULL, rating INT NOT NULL, status INT NOT NULL, author VARCHAR(20) NOT NULL, content VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE schedule');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE testimonial');
        $this->addSql('DROP TABLE `user`');
    }
}
