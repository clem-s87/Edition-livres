<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250930094014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE author (id SERIAL NOT NULL, name VARCHAR(255) DEFAULT NULL, firtname VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE category (id SERIAL NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE dimension (id SERIAL NOT NULL, livre_id INT NOT NULL, height NUMERIC(5, 2) DEFAULT NULL, width NUMERIC(5, 2) DEFAULT NULL, thickness NUMERIC(5, 2) DEFAULT NULL, weight NUMERIC(5, 2) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CA9BC19C37D925CB ON dimension (livre_id)');
        $this->addSql('CREATE TABLE fav (id SERIAL NOT NULL, book_id INT NOT NULL, users_id INT NOT NULL, adddate TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_769BE06F16A2B381 ON fav (book_id)');
        $this->addSql('CREATE INDEX IDX_769BE06F67B3B43D ON fav (users_id)');
        $this->addSql('COMMENT ON COLUMN fav.adddate IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE livres (id SERIAL NOT NULL, author_id INT NOT NULL, category_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, price NUMERIC(5, 2) DEFAULT NULL, description TEXT DEFAULT NULL, cover VARCHAR(255) DEFAULT NULL, stock INT NOT NULL, available BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_927187A4F675F31B ON livres (author_id)');
        $this->addSql('CREATE INDEX IDX_927187A412469DE2 ON livres (category_id)');
        $this->addSql('CREATE TABLE "order" (id SERIAL NOT NULL, order_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, total_price NUMERIC(5, 2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN "order".order_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE order_line (id SERIAL NOT NULL, orderid INT NOT NULL, quantity INT NOT NULL, unitprice NUMERIC(5, 2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE role (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE users (id SERIAL NOT NULL, iduser_id INT NOT NULL, role_id INT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('CREATE INDEX IDX_1483A5E9786A81FB ON users (iduser_id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9D60322AC ON users (role_id)');
        $this->addSql('COMMENT ON COLUMN users.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE dimension ADD CONSTRAINT FK_CA9BC19C37D925CB FOREIGN KEY (livre_id) REFERENCES livres (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fav ADD CONSTRAINT FK_769BE06F16A2B381 FOREIGN KEY (book_id) REFERENCES livres (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fav ADD CONSTRAINT FK_769BE06F67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE livres ADD CONSTRAINT FK_927187A4F675F31B FOREIGN KEY (author_id) REFERENCES author (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE livres ADD CONSTRAINT FK_927187A412469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9786A81FB FOREIGN KEY (iduser_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9D60322AC FOREIGN KEY (role_id) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE dimension DROP CONSTRAINT FK_CA9BC19C37D925CB');
        $this->addSql('ALTER TABLE fav DROP CONSTRAINT FK_769BE06F16A2B381');
        $this->addSql('ALTER TABLE fav DROP CONSTRAINT FK_769BE06F67B3B43D');
        $this->addSql('ALTER TABLE livres DROP CONSTRAINT FK_927187A4F675F31B');
        $this->addSql('ALTER TABLE livres DROP CONSTRAINT FK_927187A412469DE2');
        $this->addSql('ALTER TABLE users DROP CONSTRAINT FK_1483A5E9786A81FB');
        $this->addSql('ALTER TABLE users DROP CONSTRAINT FK_1483A5E9D60322AC');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE dimension');
        $this->addSql('DROP TABLE fav');
        $this->addSql('DROP TABLE livres');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('DROP TABLE order_line');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE users');
    }
}
