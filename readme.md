# Weather API Project

## Sobre o Projeto
Estou desenvolvendo uma Weather API em PHP com Docker. É um projeto para buscar e retornar dados meteorológicos. 

## Estrutura Atual do Projeto
```
weather-api/
├── docker/
│   ├── nginx/
│   │   └── nginx.conf
│   ├── php/
│   │   └── Dockerfile
│   └── docker-compose.yml
├── public/
│   └── index.php
├── src/
│   └── 
├── .env
├── .env.example
├── composer.json
└── readme.md
```

## Tecnologias em Uso
- **PHP 8.2** com PHP-FPM
- **Docker** com Nginx, PHP e Redis
- **Guzzle** para requisições HTTP
- **Predis** para cache Redis
- **APIs meteorológicas externas** (a definir)