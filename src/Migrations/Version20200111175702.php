<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200111175702 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE purchases_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, email VARCHAR(180) NOT NULL, name VARCHAR(180) NOT NULL, ip VARCHAR(180) NOT NULL, is_active BOOLEAN NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('CREATE TABLE markets (id INT NOT NULL, name VARCHAR(200) NOT NULL, related_name VARCHAR(200) NOT NULL, is_active BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE market_products (id INT NOT NULL, market_id INT NOT NULL, title VARCHAR(200) NOT NULL, img_url VARCHAR(255) DEFAULT NULL, price VARCHAR(100) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5E0B4F92622F3F37 ON market_products (market_id)');
        $this->addSql('CREATE TABLE purchases (id INT NOT NULL, owner_id INT NOT NULL, product_name VARCHAR(255) NOT NULL, product_price VARCHAR(100) DEFAULT NULL, product_market VARCHAR(200) DEFAULT NULL, date_of_purchase TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, check_serial_number VARCHAR(250) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AA6431FE7E3C61F9 ON purchases (owner_id)');
        $this->addSql('CREATE TABLE purchases_markets (purchases_id INT NOT NULL, markets_id INT NOT NULL, PRIMARY KEY(purchases_id, markets_id))');
        $this->addSql('CREATE INDEX IDX_2E9CFB2E559939B3 ON purchases_markets (purchases_id)');
        $this->addSql('CREATE INDEX IDX_2E9CFB2E5FAE3715 ON purchases_markets (markets_id)');
        $this->addSql('ALTER TABLE market_products ADD CONSTRAINT FK_5E0B4F92622F3F37 FOREIGN KEY (market_id) REFERENCES markets (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE purchases ADD CONSTRAINT FK_AA6431FE7E3C61F9 FOREIGN KEY (owner_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE purchases_markets ADD CONSTRAINT FK_2E9CFB2E559939B3 FOREIGN KEY (purchases_id) REFERENCES purchases (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE purchases_markets ADD CONSTRAINT FK_2E9CFB2E5FAE3715 FOREIGN KEY (markets_id) REFERENCES markets (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE purchases DROP CONSTRAINT FK_AA6431FE7E3C61F9');
        $this->addSql('ALTER TABLE market_products DROP CONSTRAINT FK_5E0B4F92622F3F37');
        $this->addSql('ALTER TABLE purchases_markets DROP CONSTRAINT FK_2E9CFB2E5FAE3715');
        $this->addSql('ALTER TABLE purchases_markets DROP CONSTRAINT FK_2E9CFB2E559939B3');
        $this->addSql('DROP SEQUENCE purchases_id_seq CASCADE');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE markets');
        $this->addSql('DROP TABLE market_products');
        $this->addSql('DROP TABLE purchases');
        $this->addSql('DROP TABLE purchases_markets');
    }
}
