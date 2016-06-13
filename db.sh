#!/bin/bash

mysql -uroot  -e "drop database board;"

mysql -uroot  -e "create database board character set UTF8;"

mysql -uroot  board -e "create table log (id MEDIUMINT NOT NULL AUTO_INCREMENT  , username varchar(256) ,message varchar(256) ,sdate varchar(256) PRIMARY KEY(id));"
