<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200125173406 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE market_products_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE markets_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE credit_card_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE payment_method_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE purchase_check_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE purchases_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, email VARCHAR(180) NOT NULL, name VARCHAR(180) NOT NULL, ip VARCHAR(180) NOT NULL, is_active BOOLEAN NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('CREATE TABLE user_product (id INT NOT NULL, owner_id INT NOT NULL, payment_method_id INT NOT NULL, market_product_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, price VARCHAR(150) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8B471AA77E3C61F9 ON user_product (owner_id)');
        $this->addSql('CREATE INDEX IDX_8B471AA75AA1164F ON user_product (payment_method_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8B471AA72B7A3246 ON user_product (market_product_id)');
        $this->addSql('CREATE TABLE market_products (id INT NOT NULL, market_id INT NOT NULL, product_category_id INT DEFAULT NULL, title VARCHAR(200) NOT NULL, image VARCHAR(255) DEFAULT NULL, price VARCHAR(100) NOT NULL, link VARCHAR(255) NOT NULL, link_hash VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5E0B4F92622F3F37 ON market_products (market_id)');
        $this->addSql('CREATE INDEX IDX_5E0B4F92BE6903FD ON market_products (product_category_id)');
        $this->addSql('CREATE TABLE markets (id INT NOT NULL, name VARCHAR(200) NOT NULL, related_name VARCHAR(200) NOT NULL, link VARCHAR(255) NOT NULL, is_active BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE product_category (id INT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE credit_card (id INT NOT NULL, payment_method_id INT NOT NULL, owner_id INT NOT NULL, name VARCHAR(200) NOT NULL, number INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_11D627EE5AA1164F ON credit_card (payment_method_id)');
        $this->addSql('CREATE INDEX IDX_11D627EE7E3C61F9 ON credit_card (owner_id)');
        $this->addSql('CREATE TABLE payment_method (id INT NOT NULL, method VARCHAR(200) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE purchase_check (id INT NOT NULL, market_id INT NOT NULL, purchase_id INT NOT NULL, payment_method_id INT NOT NULL, product_name VARCHAR(255) NOT NULL, price VARCHAR(100) NOT NULL, serial_number VARCHAR(200) DEFAULT NULL, file_path VARCHAR(200) DEFAULT NULL, date_of_purchase TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E8452F39622F3F37 ON purchase_check (market_id)');
        $this->addSql('CREATE INDEX IDX_E8452F39558FBEB9 ON purchase_check (purchase_id)');
        $this->addSql('CREATE INDEX IDX_E8452F395AA1164F ON purchase_check (payment_method_id)');
        $this->addSql('CREATE TABLE purchases (id INT NOT NULL, owner_id INT NOT NULL, name VARCHAR(200) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AA6431FE7E3C61F9 ON purchases (owner_id)');
        $this->addSql('ALTER TABLE user_product ADD CONSTRAINT FK_8B471AA77E3C61F9 FOREIGN KEY (owner_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_product ADD CONSTRAINT FK_8B471AA75AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_product ADD CONSTRAINT FK_8B471AA72B7A3246 FOREIGN KEY (market_product_id) REFERENCES market_products (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE market_products ADD CONSTRAINT FK_5E0B4F92622F3F37 FOREIGN KEY (market_id) REFERENCES markets (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE market_products ADD CONSTRAINT FK_5E0B4F92BE6903FD FOREIGN KEY (product_category_id) REFERENCES product_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE credit_card ADD CONSTRAINT FK_11D627EE5AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE credit_card ADD CONSTRAINT FK_11D627EE7E3C61F9 FOREIGN KEY (owner_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE purchase_check ADD CONSTRAINT FK_E8452F39622F3F37 FOREIGN KEY (market_id) REFERENCES markets (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE purchase_check ADD CONSTRAINT FK_E8452F39558FBEB9 FOREIGN KEY (purchase_id) REFERENCES purchases (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE purchase_check ADD CONSTRAINT FK_E8452F395AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE purchases ADD CONSTRAINT FK_AA6431FE7E3C61F9 FOREIGN KEY (owner_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_product DROP CONSTRAINT FK_8B471AA77E3C61F9');
        $this->addSql('ALTER TABLE credit_card DROP CONSTRAINT FK_11D627EE7E3C61F9');
        $this->addSql('ALTER TABLE purchases DROP CONSTRAINT FK_AA6431FE7E3C61F9');
        $this->addSql('ALTER TABLE user_product DROP CONSTRAINT FK_8B471AA72B7A3246');
        $this->addSql('ALTER TABLE market_products DROP CONSTRAINT FK_5E0B4F92622F3F37');
        $this->addSql('ALTER TABLE purchase_check DROP CONSTRAINT FK_E8452F39622F3F37');
        $this->addSql('ALTER TABLE market_products DROP CONSTRAINT FK_5E0B4F92BE6903FD');
        $this->addSql('ALTER TABLE user_product DROP CONSTRAINT FK_8B471AA75AA1164F');
        $this->addSql('ALTER TABLE credit_card DROP CONSTRAINT FK_11D627EE5AA1164F');
        $this->addSql('ALTER TABLE purchase_check DROP CONSTRAINT FK_E8452F395AA1164F');
        $this->addSql('ALTER TABLE purchase_check DROP CONSTRAINT FK_E8452F39558FBEB9');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_product_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE market_products_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE markets_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE credit_card_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE payment_method_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE purchase_check_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE purchases_id_seq CASCADE');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE user_product');
        $this->addSql('DROP TABLE market_products');
        $this->addSql('DROP TABLE markets');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE credit_card');
        $this->addSql('DROP TABLE payment_method');
        $this->addSql('DROP TABLE purchase_check');
        $this->addSql('DROP TABLE purchases');
    }
}
