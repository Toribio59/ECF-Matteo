CREATE DATABASE IF NOT EXISTS garage;

GRANT ALL PRIVILEGES ON garage.* TO 'symfony'@'%';

FLUSH PRIVILEGES;

USE garage;