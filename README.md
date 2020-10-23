# API LARAVEL COM VUE


## Instalação

Requisitos
```bash
composer instalado na maquina
```

Clonar o projeto
```bash
$ git clone https://github.com/aldaircerdeira2019/crud_produtos.git
```

Na pasta do projeto executa o comando para instala as depêndecias 
```bash
$ composer install
```

Copia arquivo .env
```bash
$ cp .env.example .env
```

Gera chave
```bash
$ php artisan key:generate
```

Cria um banco de dados vazio (MySQL)

Configurar o banco de dados no arquivo .env
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

Execute o comando para migrar as migrations e seeds
```bash
$ php artisan migrate --seed
```

Roda servidor
```bash
$ php artisan serve
```

## O sistema:

 <p><b>Frammework:</b>             Laravel 7</p>
 <p><b>Framework front-end:</b>    Bootstrap v4.5.3 | VUE v2.5</p>

## Recursos:
-	Utilização de Migrations, Seeders e Factories;
-	Utilização de componetes VUE;
-   View em Modal
