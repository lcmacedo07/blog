
# Setup Docker Para Projetos Laravel 9 com PHP 8

### Passo a passo
Clone Repositório
```sh
git clone https://github.com/lcmacedo07/blog
```

```sh
cd blog/
```

Crie o Arquivo .env
```sh
cd blog/
cp .env.example .env
```


Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME=blog
APP_URL=http://localhost:8955

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=blog
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

Suba os containers do projeto
```sh
docker-compose up -d
```

Acessar o container
```sh
docker-compose exec app bash
```

Instalar as dependências do projeto
```sh
composer install
```

Gerar a key do projeto Laravel
```sh
php artisan key:generate

Acesse o projeto
[http://localhost:8955](http://localhost:8955)
