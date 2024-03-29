<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240211090558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE answer (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, content VARCHAR(255) NOT NULL, correct BOOLEAN NOT NULL, question INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DADD4A25B6F7494E ON answer (question)');
        $this->addSql('CREATE TABLE answer_attempt (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, correct BOOLEAN NOT NULL, test INT NOT NULL, question_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_50ACCD17D87F7E0C ON answer_attempt (test)');
        $this->addSql('CREATE INDEX IDX_50ACCD171E27F6BF ON answer_attempt (question_id)');
        $this->addSql('CREATE TABLE answer_attempt_answer (answer_attempt_id INT NOT NULL, answer_id INT NOT NULL, PRIMARY KEY(answer_attempt_id, answer_id))');
        $this->addSql('CREATE INDEX IDX_523B7FB9DE1C3655 ON answer_attempt_answer (answer_attempt_id)');
        $this->addSql('CREATE INDEX IDX_523B7FB9AA334807 ON answer_attempt_answer (answer_id)');
        $this->addSql('CREATE TABLE question (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, content VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B6F7494EFEC530A9 ON question (content)');
        $this->addSql('CREATE TABLE test (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25B6F7494E FOREIGN KEY (question) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer_attempt ADD CONSTRAINT FK_50ACCD17D87F7E0C FOREIGN KEY (test) REFERENCES test (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer_attempt ADD CONSTRAINT FK_50ACCD171E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer_attempt_answer ADD CONSTRAINT FK_523B7FB9DE1C3655 FOREIGN KEY (answer_attempt_id) REFERENCES answer_attempt (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer_attempt_answer ADD CONSTRAINT FK_523B7FB9AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A25B6F7494E');
        $this->addSql('ALTER TABLE answer_attempt DROP CONSTRAINT FK_50ACCD17D87F7E0C');
        $this->addSql('ALTER TABLE answer_attempt DROP CONSTRAINT FK_50ACCD171E27F6BF');
        $this->addSql('ALTER TABLE answer_attempt_answer DROP CONSTRAINT FK_523B7FB9DE1C3655');
        $this->addSql('ALTER TABLE answer_attempt_answer DROP CONSTRAINT FK_523B7FB9AA334807');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE answer_attempt');
        $this->addSql('DROP TABLE answer_attempt_answer');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE test');
    }
}
