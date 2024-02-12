<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240212181656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO question (id, content) VALUES (1, \'1 + 1 =\')');
        $this->addSql('INSERT INTO question (id, content) VALUES (2, \'2 + 2 =\')');
        $this->addSql('INSERT INTO question (id, content) VALUES (3, \'3 + 3 =\')');
        $this->addSql('INSERT INTO question (id, content) VALUES (4, \'4 + 4 =\')');
        $this->addSql('INSERT INTO question (id, content) VALUES (5, \'5 + 5 =\')');
        $this->addSql('INSERT INTO question (id, content) VALUES (6, \'6 + 6 =\')');
        $this->addSql('INSERT INTO question (id, content) VALUES (7, \'7 + 7 =\')');
        $this->addSql('INSERT INTO question (id, content) VALUES (8, \'8 + 8 =\')');
        $this->addSql('INSERT INTO question (id, content) VALUES (9, \'9 + 9 =\')');
        $this->addSql('INSERT INTO question (id, content) VALUES (10, \'10 + 10 =\')');

        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (1, \'3\', false, 1)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (2, \'2\', true, 1)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (3, \'0\', false, 1)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (4, \'4\', true, 2)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (5, \'3 + 1\', true, 2)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (6, \'10\', false, 2)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (7, \'1 + 5\', true, 3)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (8, \'1\', false, 3)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (9, \'6\', true, 3)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (10, \'2 + 4\', true, 3)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (11, \'8\', true, 4)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (12, \'4\', false, 4)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (13, \'0\', false, 4)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (14, \'0 + 8\', true, 4)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (15, \'6\', false, 5)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (16, \'18\', false, 5)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (17, \'10\', true, 5)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (18, \'9\', false, 5)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (19, \'0\', false, 5)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (20, \'3\', false, 6)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (21, \'9\', false, 6)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (22, \'0\', false, 6)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (23, \'12\', true, 6)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (24, \'5 + 7\', true, 6)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (25, \'5\', false, 7)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (26, \'14\', true, 7)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (27, \'16\', true, 8)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (28, \'12\', false, 8)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (29, \'9\', false, 8)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (30, \'5\', false, 8)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (31, \'18\', true, 9)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (32, \'9\', false, 9)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (33, \'17 + 1\', true, 9)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (34, \'2 + 16\', false, 9)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (35, \'0\', false, 10)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (36, \'2\', false, 10)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (37, \'8\', false, 10)');
        $this->addSql('INSERT INTO answer (id, content, correct, question) VALUES (38, \'20\', true, 10)');
    }

    public function down(Schema $schema): void
    {
    }
}
