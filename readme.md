# Weather API

**API REST meteorológica desenvolvida com PHP, Docker e Redis**

## Visão Geral

API robusta de dados meteorológicos que integra com a Visual Crossing Weather API, implementando cache Redis para melhor performance e containerização Docker para facilitar o deploy.

## Stack Tecnológica

- **PHP 8.2**
- **Docker**
- **Nginx**
- **Redis**
- **Guzzle**
- **Composer**
- **PHPUnit**
- **Visual Crossing Weather API**

## Endpoints da API

```
GET /health                       # Verificação de saúde
GET /weather/{localidade}         # Dados meteorológicos completos
GET /weather/{localidade}/current # Condições atuais
```

## Início Rápido

```bash
# Configurar ambiente
cp .env.example .env
# Adicionar sua WEATHER_API_KEY no .env

# Executar com Docker
docker-compose up -d --build

# Testar a API
curl http://localhost:8080/weather/São%20Paulo
```

## Estrutura do Projeto

```
src/
├── Controllers/     # Controle de requisições
├── Services/        # Lógica de negócio
├── Cache/          # Integração Redis
└── Router.php      # Gerenciamento de rotas
```

---

*Desenvolvido para demonstrar práticas modernas de desenvolvimento PHP com containerização e estratégias de cache.*