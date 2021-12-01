#!/bin/bash

echo "##### Cria os Containers #####"
docker-compose up -d --build

echo "##### Copia o .env #####"
cp .env.example .env

echo "##### Instala os Pacotes da Aplicação #####"
docker exec -it teste-amarassist-php-fpm composer install

echo "##### Gera a Chave da Aplicação"
docker exec -it teste-amarassist-php-fpm php artisan key:generate

echo "##### Cria as Tabelas e Popula o Banco de Dados #####"
docker exec -it teste-amarassist-php-fpm php artisan migrate:fresh --seed

echo "##### Executa os Casos de Teste #####"
sh run-tests.sh
