<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190421135155 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, writer_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description VARCHAR(1200) DEFAULT NULL, number_pages INT NOT NULL, date DATE NOT NULL, pdf VARCHAR(255) DEFAULT NULL, image VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_CBE5A3311BC7E6B6 (writer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genres_list (book_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_D485528B16A2B381 (book_id), INDEX IDX_D485528B12469DE2 (category_id), PRIMARY KEY(book_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE writer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A3311BC7E6B6 FOREIGN KEY (writer_id) REFERENCES writer (id)');
        $this->addSql('ALTER TABLE genres_list ADD CONSTRAINT FK_D485528B16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genres_list ADD CONSTRAINT FK_D485528B12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE genres_list DROP FOREIGN KEY FK_D485528B16A2B381');
        $this->addSql('ALTER TABLE genres_list DROP FOREIGN KEY FK_D485528B12469DE2');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A3311BC7E6B6');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE genres_list');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE writer');
    }
}
