<?php

namespace src\Infrastructure\seeds;

use src\Infrastructure\DatabaseConnection;

class DatabaseSeeder
{
    private $connection;

    public function __construct(DatabaseConnection $databaseConnection)
    {
        $this->connection = $databaseConnection->getConnection();
    }

    public function seed()
    {
        $this->createCoordinatesTable();
        $this->createDobTable();
        $this->createIdTable();
        $this->createTimezoneTable();
        $this->createLocationTable();
        $this->createLoginTable();
        $this->createNameTable();
        $this->createPictureTable();
        $this->createRegisteredTable();
        $this->createStreetTable();
        $this->createUserTable();
    }

    private function createCoordinatesTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS coordinates (
            id INT AUTO_INCREMENT PRIMARY KEY,
            latitude DECIMAL(10, 8) NOT NULL,
            longitude DECIMAL(11, 8) NOT NULL
        )";

        $this->connection->exec($sql);
    }

    private function createDobTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS dob (
            id INT AUTO_INCREMENT PRIMARY KEY,
            date DATE NOT NULL
        )";

        $this->connection->exec($sql);
    }

    private function createIdTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS id (
            id INT AUTO_INCREMENT PRIMARY KEY,
            value VARCHAR(255) NOT NULL
        )";

        $this->connection->exec($sql);
    }

    private function createLocationTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS location (
            id INT AUTO_INCREMENT PRIMARY KEY,
            street_number VARCHAR(255) NOT NULL,
            street_name VARCHAR(255) NOT NULL,
            city VARCHAR(255) NOT NULL,
            state VARCHAR(255) NOT NULL,
            country VARCHAR(255) NOT NULL,
            postcode VARCHAR(255) NOT NULL,
            coordinates_id INT,
            timezone_id INT,
            FOREIGN KEY (coordinates_id) REFERENCES coordinates(id),
            FOREIGN KEY (timezone_id) REFERENCES timezone(id)
        )";

        $this->connection->exec($sql);
    }

    private function createLoginTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS login (
            id INT AUTO_INCREMENT PRIMARY KEY,
            uuid VARCHAR(255) NOT NULL,
            username VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            salt VARCHAR(255) NOT NULL,
            md5 VARCHAR(255) NOT NULL,
            sha1 VARCHAR(255) NOT NULL,
            sha256 VARCHAR(255) NOT NULL
        )";

        $this->connection->exec($sql);
    }

    private function createNameTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS name (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            first_name VARCHAR(255) NOT NULL,
            last_name VARCHAR(255) NOT NULL
        )";

        $this->connection->exec($sql);
    }

    private function createPictureTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS picture (
            id INT AUTO_INCREMENT PRIMARY KEY,
            large VARCHAR(255) NOT NULL,
            medium VARCHAR(255) NOT NULL,
            thumbnail VARCHAR(255) NOT NULL
        )";

        $this->connection->exec($sql);
    }

    private function createRegisteredTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS registered (
            id INT AUTO_INCREMENT PRIMARY KEY,
            date DATE NOT NULL,
            age INT NOT NULL
        )";

        $this->connection->exec($sql);
    }

    private function createStreetTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS street (
            id INT AUTO_INCREMENT PRIMARY KEY,
            number VARCHAR(255) NOT NULL,
            name VARCHAR(255) NOT NULL
        )";

        $this->connection->exec($sql);
    }

    private function createTimezoneTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS timezone (
            id INT AUTO_INCREMENT PRIMARY KEY,
            offset VARCHAR(255) NOT NULL,
            description VARCHAR(255) NOT NULL
        )";

        $this->connection->exec($sql);
    }

    private function createUserTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS user (
            id INT AUTO_INCREMENT PRIMARY KEY,
            gender VARCHAR(255) NOT NULL,
            coordinates_id INT,
            name_id INT,
            location_id INT,
            email VARCHAR(255) NOT NULL,
            login_id INT,
            dob_id INT,
            registered_id INT,
            phone VARCHAR(255) NOT NULL,
            cell VARCHAR(255) NOT NULL,
            id_id INT,
            picture_id INT,
            nat VARCHAR(255) NOT NULL,
            FOREIGN KEY (coordinates_id) REFERENCES coordinates(id),
            FOREIGN KEY (name_id) REFERENCES name(id),
            FOREIGN KEY (location_id) REFERENCES location(id),
            FOREIGN KEY (login_id) REFERENCES login(id),
            FOREIGN KEY (dob_id) REFERENCES dob(id),
            FOREIGN KEY (registered_id) REFERENCES registered(id),
            FOREIGN KEY (id_id) REFERENCES id(id),
            FOREIGN KEY (picture_id) REFERENCES picture(id)
        )";

        $this->connection->exec($sql);
    }
}