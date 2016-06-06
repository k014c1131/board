
#!/bin/bash

mysql -uroot  -e "drop database todolist;"

mysql -uroot  -e "create database todolist character set UTF8;"

mysql -uroot  todolist -e "create table list (id MEDIUMINT NOT NULL AUTO_INCREMENT  , item varchar(256) , PRIMARY KEY(id));"
