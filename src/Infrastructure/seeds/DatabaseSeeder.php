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
        $this->createIdUserTable();
        $this->createTimezoneTable();
        $this->createLoginTable();
        $this->createNameTable();
        $this->createPictureTable();
        $this->createRegisteredTable();
        $this->createStreetTable();
        $this->createLocationTable();
        $this->createUserTable();
    }

    private function createTable($tableName, $columns)
    {
        $sql = "CREATE TABLE IF NOT EXISTS {$tableName} (
            id INT AUTO_INCREMENT PRIMARY KEY,
            {$columns}
        )";

        $this->connection->exec($sql);
    }

    private function createCoordinatesTable()
    {
        $tableName = 'coordinates';
        $columns = 'latitude DECIMAL(10, 8) NOT NULL, longitude DECIMAL(11, 8) NOT NULL';
        $this->createTable($tableName, $columns);
    }

    private function createDobTable()
    {
        $tableName = 'dob';
        $columns = 'date VARCHAR(255) NOT NULL, age INT NOT NULL';
        $this->createTable($tableName, $columns);
    }

    private function createIdUserTable()
    {
        $tableName = 'iduser';
        $columns = 'value VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL';
        $this->createTable($tableName, $columns);
    }

    private function createTimezoneTable()
    {
        $tableName = 'timezone';
        $columns = 'offset VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL';
        $this->createTable($tableName, $columns);
    }

    private function createLocationTable()
    {
        $tableName = 'location';
        $columns = 'streetId INT, city VARCHAR(255) NOT NULL, state VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, postcode VARCHAR(255) NOT NULL, coordinatesId INT, timezoneId INT, FOREIGN KEY (streetId) REFERENCES street(id), FOREIGN KEY (coordinatesId) REFERENCES coordinates(id), FOREIGN KEY (timezoneId) REFERENCES timezone(id)';
        $this->createTable($tableName, $columns);
    }

    private function createLoginTable()
    {
        $tableName = 'login';
        $columns = 'uuid VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, salt VARCHAR(255) NOT NULL, md5 VARCHAR(255) NOT NULL, sha1 VARCHAR(255) NOT NULL, sha256 VARCHAR(255) NOT NULL';
        $this->createTable($tableName, $columns);
    }

    private function createNameTable()
    {
        $tableName = 'name';
        $columns = 'title VARCHAR(255) NOT NULL, first VARCHAR(255) NOT NULL, last VARCHAR(255) NOT NULL';
        $this->createTable($tableName, $columns);
    }

    private function createPictureTable()
    {
        $tableName = 'picture';
        $columns = 'large VARCHAR(255) NOT NULL, medium VARCHAR(255) NOT NULL, thumbnail VARCHAR(255) NOT NULL';
        $this->createTable($tableName, $columns);
    }

    private function createRegisteredTable()
    {
        $tableName = 'registered';
        $columns = 'date VARCHAR(255) NOT NULL, age INT NOT NULL';
        $this->createTable($tableName, $columns);
    }

    private function createStreetTable()
    {
        $tableName = 'street';
        $columns = 'number VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL';
        $this->createTable($tableName, $columns);
    }

    private function createUserTable()
    {
        $tableName = 'user';
        $columns = 'gender VARCHAR(255) NOT NULL, nameId INT, locationId INT, email VARCHAR(255) NOT NULL, loginId INT, dobId INT, registeredId INT, phone VARCHAR(255) NOT NULL, cell VARCHAR(255) NOT NULL, iduserId INT, pictureId INT, nat VARCHAR(255) NOT NULL, FOREIGN KEY (nameId) REFERENCES name(id), FOREIGN KEY (locationId) REFERENCES location(id), FOREIGN KEY (loginId) REFERENCES login(id), FOREIGN KEY (dobId) REFERENCES dob(id), FOREIGN KEY (registeredId) REFERENCES registered(id), FOREIGN KEY (iduserId) REFERENCES iduser(id), FOREIGN KEY (pictureId) REFERENCES picture(id)';        $this->createTable($tableName, $columns);
    }
}