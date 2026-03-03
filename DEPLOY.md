# Деплой

## 1. Подготовка сервера

```bash
curl -fsSL https://get.docker.com | sh
```

## 2. Клонировать репозиторий

```bash
git clone <repo_url> /srv/museum-smtu
cd /srv/museum-smtu
```

## 3. Настройка переменных

```bash
cp .env.example .env
nano .env
```

Ключи WordPress — сгенерировать на https://api.wordpress.org/secret-key/1.1/salt/

## 4. Запуск

```bash
docker compose up -d
```

WordPress будет доступен на `http://<IP>:8000`
phpMyAdmin — на `http://<IP>:8080`

## 5. Конфиг внешнего nginx (пример)

```nginx
server {
    listen 80;
    server_name museum.example.com;

    location / {
        proxy_pass         http://127.0.0.1:8000;
        proxy_set_header   Host              $host;
        proxy_set_header   X-Real-IP         $remote_addr;
        proxy_set_header   X-Forwarded-For   $proxy_add_x_forwarded_for;
        proxy_set_header   X-Forwarded-Proto $scheme;
    }

    client_max_body_size 64M;
}
```

## 6. WordPress — первоначальная настройка

Зайти на `http://<IP>:8000`, пройти установку.
Тема `museum-smtu` уже смонтирована — активировать в **Внешний вид → Темы**.

## Полезные команды

```bash
docker compose logs -f wordpress     # логи
docker compose exec wordpress bash   # войти в контейнер
docker compose down                  # остановить
docker compose pull && docker compose up -d  # обновить образы
```
