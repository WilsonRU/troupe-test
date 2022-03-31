### Informações

- Versão do Laravel 
```
v8.6.11
```

### Requisitos

PHP version 7.4 or maior, com as extenção instalada:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- json
- xml
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)

### Instalação

- Copiar o `.env.example` para `.env` e configurar os dados da conexão com MySQL ou PostgreSQL
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=troupe-test
DB_USERNAME=root
DB_PASSWORD=
```
- Execute `php artisan key:generate` para gerar a Application Key
- Execute `php artisan migrate` para rodar as migrações e construir a tabela de cidadão
- Execute `php artisan serve` para subir o servidor de teste na porta 8000

### Documentação de Rotas da API

- POST /api/citizen/create
```
{
    "nome": "Nome",
    "sobrenome": "Cidadão",
    "cpf": "12345678900",
    "email": "nomecidadao@gmail.com",
    "celular": "82999999999",
    "cep": "57071700"
}
```
```
Retorno
{
  "status_code": 201,
  "message": "Successfully created"
  "data": {
		"nome": "Nome",
		"sobrenome": "Cidadão",
		"cpf": "12345678900",
		"email": "nomecidadao@gmail.com",
		"celular": "82999999999",
		"cep": "57071700",
		"logradouro": "Rua Supervisor Ivaldo Ferino",
		"bairro": "Clima Bom",
		"cidade": "Maceió",
		"uf": "AL",
		"updated_at": "2022-03-31T20:16:50.000000Z",
		"created_at": "2022-03-31T20:16:50.000000Z",
		"id": 11
	}
}
```
- GET /api/citizen/search/{CPF Do Cidadão}
```
Retorno
{
[
	{
		"id": 11,
		"nome": "Nome",
		"sobrenome": "Cidadão",
		"cpf": "12345678900",
		"email": "nomecidadao@gmail.com",
		"celular": "82999999999",
		"cep": 57071700,
		"logradouro": "Rua Supervisor Ivaldo Ferino",
		"bairro": "Clima Bom",
		"cidade": "Maceió",
		"uf": "AL",
		"created_at": "2022-03-31T20:16:50.000000Z",
		"updated_at": "2022-03-31T20:16:50.000000Z",
		"deleted_at": null
	}
]
}
```
- GET /api/citizen
```
Retorno
{
    [
        {
            "id": 11,
            "nome": "Nome",
            "sobrenome": "Cidadão",
            "cpf": "12345678900",
            "email": "nomecidadao@gmail.com",
            "celular": "82999999999",
            "cep": 57071700,
            "logradouro": "Rua Supervisor Ivaldo Ferino",
            "bairro": "Clima Bom",
            "cidade": "Maceió",
            "uf": "AL",
            "created_at": "2022-03-31T20:16:50.000000Z",
            "updated_at": "2022-03-31T20:16:50.000000Z",
            "deleted_at": null
        }
    ]
}
```
```
- DELETE /api/citizen/delete/{ID Do Cidadão}
```
Retorno
{
	"message": "Successfully deleted"
}
```

### Cadastrando um Cidadão pelo CLI

- Execute `php artisan create:citizen` e siga as intruções.