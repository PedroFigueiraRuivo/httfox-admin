
# CMS httFox

Tema WordPress para gerenciar backend do site e sistemas da httfox


## Dependências
[![7.4 php_version](https://img.shields.io/badge/php_version-^7.4-blue.svg)](https://choosealicense.com/licenses/mit/)

[![6.0 wp_version](https://img.shields.io/badge/wp_version-^6.0-skyblue.svg)](https://choosealicense.com/licenses/mit/)


# Endpoint de Serviços

O endpoint `/httfox-api/v1/services` permite obter uma lista de serviços. Esse endpoint retorna informações gerais de todos os serviços.

## Requisição

**Método:** GET
**Caminho:** /httfox-api/v1/services

## Parâmetros

- `paged` (opcional): Página da lista de serviços.
- `category` (opcional): Slug da categoria de serviços.

## Resposta

Em caso de sucesso, a resposta conterá um array com informações sobre os serviços. Cada serviço terá:

- `id`: ID do serviço.
- `slug`: Slug do serviço.
- `title`: Título do serviço.
- `attachment_img`: URL da imagem em destaque do serviço.

Em caso de erro (nenhum serviço encontrado), a resposta conterá um erro 404.

## Exemplo de Requisição

```http
GET /httfox-api/v1/services?paged=1&category=categoria-exemplo
```

## Exemplo de Resposta

```json
{
  "total_pages": 3,
  "services": [
    {
      "id": 1,
      "slug": "servico-exemplo",
      "title": "Serviço de Exemplo",
      "attachment_img": "https://example.com/imagem.jpg"
    },
    // ... outros serviços ...
  ]
}
```

# Observações
- Certifique-se de estar autenticado ou ter permissões adequadas para acessar este endpoint.

## Licença

[GPLv2](https://choosealicense.com/licenses/gpl-2.0/)

