<?php

class Config {
    private const DB_SERVER = "localhost";
    private const DB_NAME = "xml_to_emmet";
    private const DB_USERNAME = "tegu";
    private const DB_PASSWORD = "1234";

    public static function create_mysql_connection() {
        $connection = new mysqli(Config::DB_SERVER, Config::DB_USERNAME, Config::DB_PASSWORD) or die("Database connection failed..");
        $connection -> query("create database if not exists ".Config::DB_NAME);
        $connection -> select_db(Config::DB_NAME);

        return $connection;
    }

    public static function mysql_conection(){
        $connection = mysqli_connect(Config::DB_SERVER, Config::DB_USERNAME, Config::DB_PASSWORD, Config::DB_NAME);
        if (!$connection) {

            echo "Connection failed!";
        
        }
        return $connection;
    }
}

$connection = Config::create_mysql_connection();

$users_table = "create table if not exists users (
    id int auto_increment not null primary key,
    email varchar(200) not null,
    username varchar(100) not null,
    password varchar(256) not null
)";

$connection -> query($users_table);

$conversions_table = "create table if not exists conversions (
    id int auto_increment not null primary key,
    from_what enum('xml', 'emmet') not null,
    to_what enum('xml', 'emmet') not null,
    content_to_convert text not null,
    result_from_conversion text not null
)";

$connection -> query($conversions_table);

$users_conversions_table = "create table if not exists users_conversions (
    user_id int not null,
    conversion_id int not null,
    converted_at date,
    primary key(user_id, conversion_id),

    foreign key(user_id) references users(id),
    foreign key(conversion_id) references conversions(id)
)";

$connection -> query($users_conversions_table);
?>