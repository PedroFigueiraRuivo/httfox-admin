
# CMS httFox

Gerenciador backend do site e sistemas da httfox


## Dependências
[![7.4 php_version](https://img.shields.io/badge/php_version-^7.4-blue.svg)](https://choosealicense.com/licenses/mit/)

[![6.0 wp_version](https://img.shields.io/badge/wp_version-^6.0-skyblue.svg)](https://choosealicense.com/licenses/mit/)

[![6.2.1.1 acf_version](https://img.shields.io/badge/acf_version-^6.2.1.1-skyblue.svg)](https://choosealicense.com/licenses/mit/)

(ACF está incluso em includes/plugins)



# Documentação da API
A api da httFox utiliza a rota `/httfox-api/[version]` seguida do endpoint para retornar, adicinar, autualizar ou remover valores do sistema wordpress.

## Menu
Segue abaixo a lista dos endpoints

-- Informações gerais GET \
<a href="#api-perguntas-frequentes">Perguntas frequentes</a> \
<a href="#api-diferenciais">Diferenciais</a>

-- Custom post Types GET \
<a href="#api-servicos">Serviços</a> \
<a href="#api-portfolio">Portfólio</a> \
<a href="#api-depoimentos">Depoimentos</a>

-- Emails POST \
<a href="#api-sendmails">Envio de e-mails</a>



<h2 id="api-perguntas-frequentes">- Perguntas frequesntes</h2>

Este endpoint permite obter uma lista de das perguntas frequentes cadastradas na aba de informações gerais.

### Requisição

**Método:** GET \
**Caminho:** `/httfox-api/[version]/common-questions` \
**Corpo (opcional):** 
```json
{
	"itens_per_page": 0,
	"paged": 0
}
```
- `itens_per_page` (opcional): number: quantidade de itens por página. Padrão: 0 (lista todos).
- `paged` (opcional): number: página a ser resgatada. Padrão: 1.

### Resposta

Em caso de sucesso, a resposta conterá:

- `total_items`: number: total de itens existentes.
- `total_pages`: number: total de páginas acessíveis (varia de acordo com o parâmetro passado: `itens_per_page`).
- `paged`: number: Página atual.
- `common_questions`: array obj: listagem dos itens.

Cada item do array de objetos `common_questions` retorna:
- `id_on_page`: number: indice da listagem.
- `id_on_page`: string: pergunta.
- `id_on_page`: string: resposta.


Em caso de erro (nenhum item encontrado), a resposta conterá um erro 404.

Há também a possibilidade da página de cadastro não existir, o que retornará: "Config not defined", com um erro 404

### Exemplo de Requisição

```http
GET /httfox-api/v1/common-questions
```

```json
{
	"itens_per_page": 2,
	"paged": 3
}
```
(Mostra a terceira página com 2 itens.)

### Exemplo de Resposta

```json
{
	"total_items": 13,
	"total_pages": 7,
	"paged": 3,
	"common_questions": [
		{
			"id_on_page": 4,
			"question": "O que preciso ter para iniciar um projeto?",
			"enswere": "O que preciso ter para iniciar um projeto?"
		},
		{
			"id_on_page": 5,
			"question": "O que preciso ter para iniciar um projeto?",
			"enswere": "O que preciso ter para iniciar um projeto?"
		}
	]
}
```
\
\
\
\
<h2 id="api-diferenciais">- Diferenciais</h2>

Este endpoint permite obter uma lista de dos diferenciais cadastradas na aba de informações gerais.

### Requisição

**Método:** GET \
**Caminho:** `/httfox-api/[version]/differentials` \
**Corpo (opcional):** 
```json
{
	"itens_per_page": 0,
	"paged": 0
}
```
- `itens_per_page` (opcional): number: quantidade de itens por página. Padrão: 0 (lista todos).
- `paged` (opcional): number: página a ser resgatada. Padrão: 1.

### Resposta

Em caso de sucesso, a resposta conterá:

- `total_items`: number: total de itens existentes.
- `total_pages`: number: total de páginas acessíveis (varia de acordo com o parâmetro passado: `itens_per_page`).
- `paged`: number: Página atual.
- `differentials`: array obj: listagem dos itens.

Em caso de erro (nenhum item encontrado), a resposta conterá um erro 404.

Há também a possibilidade da página de cadastro não existir, o que retornará: "Config not defined", com um erro 404

### Exemplo de Requisição

```http
GET /httfox-api/v1/differentials
```

```json
{
	"itens_per_page": 2,
	"paged": 2
}
```
(Mostra a segunda página com 2 itens.)

### Exemplo de Resposta

```json
{
	"total_items": 4,
	"total_pages": 2,
	"paged": 2,
	"differentials": [
		{
			"id_on_page": 2,
			"title": "jbw iougd soiu ",
			"excerpt": "sa s rgsd gdfsgshg xfgd ",
			"thumbnail": "http:\/\/localhost\/adm.httfox.com\/wp-content\/uploads\/2023\/09\/notebookTyping.png",
			"note": false
		},
		{
			"id_on_page": 3,
			"title": "gt hdh dh dfgd hd ",
			"excerpt": " sd ggsw tggrh dbd",
			"thumbnail": "http:\/\/localhost\/adm.httfox.com\/wp-content\/uploads\/2023\/08\/image-35.jpg",
			"note": false
		}
	]
}
```
\
\
\
\
<h2 id="api-servicos">- Serviços</h2>

Este endpoint endpoint permite obter uma lista de serviços. Ela retorna informações gerais de todos os serviços assim como uma lista dos itens da taxonomia "categorias" atrelada ao CPT Serviços.

### Requisição

**Método:** GET \
**Caminho:** /httfox-api/[version]/services \
**Corpo (opcional):** \
```json
{
	"paged": 0,
	"itens_per_page": 0,
	"category": "string"
}
```

### Parâmetros

- `paged` (opcional): number: Página da lista de serviços.
- `itens_per_page` (opcional): number: itens por página (padrão: 0 -> lista todos os itens).
- `category` (opcional): string: Slug da categoria de serviços.

### Resposta

Em caso de sucesso, a resposta conterá um array com a listagem das categorias específicas de serviços utilizadas, o total de posts existentes, o número de paginações possíveis, a página atual e um array com informações sobre os serviços. 
- `paged`: Página atual.
- `categories`: Array|String com as categorias usadas.
- `total_pages`: Total de páginas disponíveis (varia de acordo com `itens_per_page`).
- `services`: Array|Obj com os serviços.
- `total_items`: Total de itens retornados.

Cada serviço terá:

- `id`: ID do serviço.
- `slug`: Slug do serviço.
- `title`: Título do serviço.
- `attachment_img`: URL da imagem em destaque do serviço.

Em caso de erro (nenhum serviço encontrado), a resposta conterá um erro 404.

### Exemplo de Requisição

```http
GET /httfox-api/v1/services
```

```json
{
	"paged": 1,
	"itens_per_page": 1,
	"category": "maintenance"
}
```
(Mostra a primeira página, com um item por página, dos itens percententes a "maintenance")

### Exemplo de Resposta

```json
{
	"paged": 1,
	"categories": [
		"additional",
		"maintenance",
		"new-projects"
	],
	"total_pages": 4,
	"services": [
		{
			"id": 256,
			"slug": "ghg-t-xh-4",
			"title": "ghg t xh",
			"attachment_img": false
		}
	],
	"total_items": 4
}
```
\
\
\
\
<h2 id="api-servicos">- Depoimentos</h2>

Este endpoint endpoint permite obter uma lista dos depoimentos. Ela retorna informações gerais de todos os depoimentos assim como umao total de páginas disponíveis e a página atual

### Requisição

**Método:** GET \
**Caminho:** /httfox-api/[version]/depositions \
**Corpo (opcional):** \
```json
{
	"itens_per_page": ,
	"paged": 0
}
```

### Parâmetros

- `paged` (opcional): number: Página da lista de serviços.
- `itens_per_page` (opcional): number: itens por página (padrão: 0 -> lista todos os itens).

### Resposta

Em caso de sucesso, a resposta conterá o total de posts existentes, o número de paginações possíveis, a página atual e um array com informações sobre os serviços. 
- `paged`: Página atual.
- `total_pages`: Total de páginas disponíveis (varia de acordo com `itens_per_page`).
- `depositions`: Array|Obj com os serviços.
- `total_items`: Total de itens retornados.

Cada depoimento terá:

- `id`: ID do depoimento.
- `slug`: Slug do depoimento.
- `title`: Título do depoimento.
- `attachment_img`: URL da imagem em destaque do depoimento.

Em caso de erro (nenhum serviço encontrado), a resposta conterá um erro 404.

### Exemplo de Requisição

```http
GET /httfox-api/v1/depositions
```

```json
{
	"itens_per_page": 3,
	"paged": 2
}
```
(Mostra a segunda página, com três itens por página)

### Exemplo de Resposta

```json
{
	"paged": 2,
	"total_pages": 5,
	"depositions": [
		{
			"id": 125,
			"slug": "site-da-piaba-3",
			"title": "Site da piaba",
			"content": "Na httFox, oferecemos planos personalizados de acordo com suas necessidades. Escolha o mais adequado ou personalize o seu. Nosso objetivo é garantir o sucesso no mundo digital.",
			"author": "Marley José",
			"company": "httFox Web Developer",
			"website_url": "https:\/\/httfox.com.br\/"
		},
		// listagem
	],
	"total_items": 5
}
```
\
\
\
\
<h2 id="api-sendmails">- Envio de e-mails</h2>

Este endpoint permite que o cliente envie e-mails usando uma solicitação POST.

### Requisição

**Método:** POST \
**Caminho:** /httfox-api/[version]/sendmail \
**Corpo:** \
```json
{
	"sender": "main@email.com",
	"subject": "subject",
	"message": "email\n body",
	"from": "responseTo@email.com",
	"cc": "mail@email.com, mail2@email.com",
	"bcc": "hidden_mail@email.com",
}
```

### Corpo da Requisição

- `sender` (string, obrigatório): Endereço de e-mail do remetente.
- `subject` (string, obrigatório): Assunto do e-mail.
- `message` (string, obrigatório): Corpo da mensagem de e-mail.
- `from` (string, opcional): Endereço de e-mail do remetente (ou será o mesmo que `sender`).
- `cc` (string, opcional): Lista de endereços de e-mail, separados por vírgula, em cópia carbono (CC).
- `bcc` (string, opcional): Lista de endereços de e-mail, separados por vírgula, em cópia oculta (BCC).

### Respostas

- Se o e-mail for enviado com sucesso, a API retornará uma resposta de sucesso com um status HTTP 200 e a mensagem "Email enviado!".
- Se algum item obrigatório estiver ausente ou corresponder a "empty()", a API retornará um erro com um status HTTP 400 e uma mensagem descritiva, como "Os dados fornecidos estão incompletos ou ausentes."
- Se ocorrer alguma falha no envio a API retornará um status HTTP 500 e a mensagem "Erro ao enviar o e-mail."

### Exemplo de Solicitação

```json
{
   "sender": "endereco_de_email@exemplo.com",
   "subject": "Assunto do E-mail",
   "message": "Corpo da mensagem de e-mail",
   "from": "remetente@exemplo.com",
   "cc": ["copiacarbono1@exemplo.com", "copiacarbono2@exemplo.com"],
   "bcc": ["copiaoculta1@exemplo.com", "copiaoculta2@exemplo.com"]
}
```
# Licença

[GPLv2](https://choosealicense.com/licenses/gpl-2.0/)

