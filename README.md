# Teste Amarassist Backend
---

Foi desenvolvido uma API no formato `REST`, segue a documentação dos endpoints utilizados nessa API:
- https://www.getpostman.com/collections/cf7d1385d40a34c1997f

## Como Configurar
---

Basta executar o script `config.sh` na raíz do projeto e ele se encarrega de subir a aplicação, criar as tabelas e popular o banco com dados de teste.

## Stack Utilizada
---

A API foi desenvolvida para trabalhar com Containers (`Docker`).
A API também conta com casos de teste, utilizando o `PHPUnit`, para executar os testes, basta executar o script `run-tests.sh`.

Segue a lista de tecnologias utilizadas:

- `Docker`
- `PHP >= 7.4`
- `NGINX >= 1.16`
- `MySQL >= 5`
- `Laravel >= 8`
