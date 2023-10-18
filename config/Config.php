<?php

// URL base
define("BASE_URL", "http://localhost/blumenaubakery");

// Zona horaria
date_default_timezone_set('America/Sao_Paulo');

// Dados de conexão ao Banco de Dados
const DB_HOST = "localhost";
const DB_NAME = "blumenaubakery";
const DB_USER = "root";
const DB_PASSWORD = "";
const DB_CHARSET = "charset=utf8";

// Deliminadores decimal e milhar - Ex: 24.1989,00
const SPD = ",";
const SPM = ".";

// Símbolo da moeda
const SMONEY = "R$";

// Dados para Encriptar / Desencriptar
const KEY = 'abelosh';
const METHODENCRIPT = "AES-128-ECB";

// Entrega pedido
const CUSTOENVIO = 10;

// Dados Empresa
const NOME_EMPRESA = "Blumenau Bakery";
const ENDERECO = "R. 7 de Setembro, 1213 - Centro, Blumenau - SC, 89010-911";
const TELEFONE = "Tel: (47) 3321-8545 / (47) 98614-1729 (WhatsApp)";
const EMAIL = "info@blumenaubekary.com.br";
const SITE = "ww.blumenaubekary.com.br";