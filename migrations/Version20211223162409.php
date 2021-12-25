<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211223162409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE airport (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, code VARCHAR(3) NOT NULL, INDEX IDX_7E91F7C28BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking_status (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(90) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flight (id INT AUTO_INCREMENT NOT NULL, departure_airport_id INT NOT NULL, arrival_airport_id INT NOT NULL, status_id INT DEFAULT NULL, number VARCHAR(10) NOT NULL, travel_time TIME NOT NULL, basic_price INT DEFAULT NULL, INDEX IDX_C257E60EF631AB5C (departure_airport_id), INDEX IDX_C257E60E7F43E343 (arrival_airport_id), INDEX IDX_C257E60E6BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flight_status (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE passenger (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, last_name VARCHAR(64) NOT NULL, patronymic VARCHAR(64) DEFAULT NULL, passport_series INT NOT NULL, passport_number INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, flight_id INT NOT NULL, passenger_id INT NOT NULL, booking_status_id INT NOT NULL, departure_date DATE NOT NULL, total_price INT DEFAULT NULL, INDEX IDX_97A0ADA391F478C5 (flight_id), INDEX IDX_97A0ADA34502E565 (passenger_id), INDEX IDX_97A0ADA3F8C5CBBE (booking_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE airport ADD CONSTRAINT FK_7E91F7C28BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60EF631AB5C FOREIGN KEY (departure_airport_id) REFERENCES airport (id)');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E7F43E343 FOREIGN KEY (arrival_airport_id) REFERENCES airport (id)');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E6BF700BD FOREIGN KEY (status_id) REFERENCES flight_status (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA391F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA34502E565 FOREIGN KEY (passenger_id) REFERENCES passenger (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3F8C5CBBE FOREIGN KEY (booking_status_id) REFERENCES booking_status (id)');
        $this->addSql('INSERT INTO city (name) VALUES ("Москва"), ("Санкт-Петербург"), ("Нижний Новгород")');
        $this->addSql('INSERT INTO airport (city_id, code) VALUES (1, "DMD"), (1, "SVO"), (2, "LED"), (3, "GOJ")');
        $this->addSql('INSERT INTO flight_status (title) VALUES ("Активен"), ("Неактивен")');
        $this->addSql('INSERT INTO booking_status (title) VALUES ("Забронирован"), ("Отменен")');
        $this->addSql('INSERT INTO passenger (name, last_name, patronymic, passport_series, passport_number) VALUES ("Иван", "Крузенштерн", "Федорович", 1111, 123123)');
        $this->addSql('INSERT INTO flight (departure_airport_id, arrival_airport_id, status_id, number, travel_time, basic_price) SELECT 1, 1, 2, (SELECT GROUP_CONCAT((SELECT code FROM airport WHERE id = 1), (SELECT code FROM airport WHERE id = 2), MINUTE(NOW()), SECOND(NOW()) separator "")), "00:20:00", 1500');
        $this->addSql('INSERT INTO flight (departure_airport_id, arrival_airport_id, status_id, number, travel_time, basic_price) SELECT 1, 3, 1, (SELECT GROUP_CONCAT((SELECT code FROM airport WHERE id = 1), (SELECT code FROM airport WHERE id = 3), MINUTE(NOW()), SECOND(NOW()) separator "")), "01:10:00", 3200');
        $this->addSql('INSERT INTO flight (departure_airport_id, arrival_airport_id, status_id, number, travel_time, basic_price) SELECT 2, 3, 1, (SELECT GROUP_CONCAT((SELECT code FROM airport WHERE id = 2), (SELECT code FROM airport WHERE id = 3), MINUTE(NOW()), SECOND(NOW()) separator "")), "01:20:00", 2700');
        $this->addSql('INSERT INTO flight (departure_airport_id, arrival_airport_id, status_id, number, travel_time, basic_price) SELECT 4, 3, 1, (SELECT GROUP_CONCAT((SELECT code FROM airport WHERE id = 4), (SELECT code FROM airport WHERE id = 3), MINUTE(NOW()), SECOND(NOW()) separator "")), "01:50:00", 3700');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flight DROP FOREIGN KEY FK_C257E60EF631AB5C');
        $this->addSql('ALTER TABLE flight DROP FOREIGN KEY FK_C257E60E7F43E343');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3F8C5CBBE');
        $this->addSql('ALTER TABLE airport DROP FOREIGN KEY FK_7E91F7C28BAC62AF');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA391F478C5');
        $this->addSql('ALTER TABLE flight DROP FOREIGN KEY FK_C257E60E6BF700BD');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA34502E565');
        $this->addSql('DROP TABLE airport');
        $this->addSql('DROP TABLE booking_status');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE flight');
        $this->addSql('DROP TABLE flight_status');
        $this->addSql('DROP TABLE passenger');
        $this->addSql('DROP TABLE ticket');
    }
}
