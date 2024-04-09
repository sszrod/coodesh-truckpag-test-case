# Teste Case Coodesh

Esta aplicação implementa os processos de armazenamento de dados dos produtos importados do serviço OpenFoodFacts.

## Arquitetura

A aplicação foi modelada utilizando os patterns Command e Builder.

### Estrutura de serviços
A aplicação utiliza o servidor Laravel Octane com Swoole e Nginx como proxy.

Para desenvolvimento local, o Chokidar é utilizado para monitorar alterações no código e reiniciar o servidor.

Os detalhes da impelementação podem ser encontrados na pasta .docker/local

### Estrutura de pastas
```
├── .docker
|   ├── local
|   ├── production
├── app
|   ├── Actions
|   ├── Enums
|   ├── Http
|   |   ├── Controllers
|   |   ├── Middleware
|   |   └── Requests
|   ├── Models
|   ├── Providers

```

### Actions
Actions são classes que implementam a lógica de negócio da aplicação. Elas são responsáveis por receber os dados da requisição, validar, executar a lógica de negócio e retornar os dados para o controller.

Neste projeto, as Actions também agem como métodos de Repositório, agindo na camada de persistência.

É fundamental que uma Action sejá responsável somente por uma ação específica, seguindo o princípio da responsabilidade única.

### Ferramentas internas
[Laravel Horizon](https://laravel.com/docs/11.x/horizon)

[Laravel Pint](https://laravel.com/docs/11.x/pint)

[PHPUnit](https://phpunit.de/)

[Larastan](https://github.com/nunomaduro/larastan)

[MongoDB](https://github.com/mongodb/laravel-mongodb)

[Scramble](https://scramble.dedoc.co/)


## Configuração do ambiente de desenvolvimento

Para instalar este micro serviço no seu ambiente de desenvolvimento é necessário criar um arquivo com as variáveis de
ambiente:

```shell
cp .env.example .env
```

Subir os contêineres:

```shell
docker-compose up -d --build
```

Entre no container do php da aplicação:

```shell
docker exec -it app bash
```
Execute o seguinte comando para obter as informações iniciais
`````php
app:update-open-food-facts-products 
`````
Aguarde alguns minutos. Você pode acompanhar o processo acessando a url
````shell
http://localhost:8344/horizon/
````
Saia do container

```shell
exit
```

### Documentação dos endpoints
```shell
http://localhost:8344/docs/api
```
### NOTAS
Para esse desafio foram entrentadas os seguintes problemas a serem resolvidos:
1. Obter a lista de arquivos que seriam lidos para extrair os dados dos produtos
2. O arquivo para download está compactado como GZ.
3. O arquivo deveria ser extraído e do resultado da extração saíria o arquivo final json
4. O json para parser dos produtos não é um json válido.
5. Ambos os arquivos comprimidos e o arquivo final extraido são muito grandes: 50MB comprido e mais 1G descomprimido.

### Soluções
Para resolver o problema do tamanho do arquivo foi optado por ser feito os downloads dos arquivos e armazenados no disco local da aplicação.
Após isso foi realizado a descompressão do arquivo .gz utilizando processos nativos do próprio SO ( ubuntu ) para tal:
````shell
gzip -d nome_do_arquivo.gz
````
Com isso consegui fazer o download e extração final do arquivo 'json'.

Como comentei acima, o arquivo JSON não é um arquivo válido sendo uma lista de items separados por espaço.
Para tal fiz um pequeno hack onde pegava o conteudo do arquivo, trocava todas as ocorrencias onde falta uma virgula como caractere de separação e assim a fiz.
````php
str_replace('}', '},', $content);
````

Para finalizar a leitura do arquivo json e seu 'decode' deveria ser realizado de forma a trazer os dados em lazzy loading por conta do seu tamanho.
Após varias pesquisas encontrei um parse de json que faria justamente isso para mim:

https://github.com/cerbero90/json-parser?tab=readme-ov-file#%EF%B8%8F-decoders

Para finalizar o processo após isso ficou simples. Bastando apenas fazer as inserções na base mongo.
