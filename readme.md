# Weather API

**API REST meteorológica desenvolvida com PHP 8.2, Docker e cache Redis**

## Visão Geral

API robusta de dados meteorológicos que integra com a Visual Crossing Weather API, implementando cache Redis para melhor performance e containerização Docker para facilitar o deploy.

## Stack Tecnológica

- **Backend:** PHP 8.2
- **Infraestrutura:** Docker, Nginx
- **Cache:** Redis
- **Cliente HTTP:** Guzzle
- **Arquitetura:** Padrão MVC com separação clara de responsabilidades

## Principais Funcionalidades

- Endpoints RESTful para dados meteorológicos
- Cache Redis com TTL configurável (12h padrão)
- Ambiente de desenvolvimento containerizado
- Arquitetura limpa com injeção de dependência
- tratamento de erros e logging
- Configuração baseada em variáveis de ambiente

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

## Destaques Técnicos

- **Estratégia de Cache:** Cache inteligente com Redis reduz chamadas à API externa e melhora tempo de resposta
- **Arquitetura Docker:** Setup multi-container com PHP-FPM, Nginx e Redis
- **Tratamento de Erros:** Respostas de erro abrangentes e sistema de logs
- **Qualidade de Código:** Compliance com padrões PSR e princípios de arquitetura limpa

---

*Desenvolvido para demonstrar práticas modernas de desenvolvimento PHP com containerização e estratégias de cache.*