# WP Boilerplate

    Boilerplate de temas WP
    Custom posts, Material e grid do bootstrap

##Estrutura de pastas
```
boilerplate
├── assets
	└── coffee - * scripts *
		└── layout - * Todos os arquivos nesta pasta se tornarão layout.min.js *
	└── fonts - * Fontes do projeto devem ir aqui*
	└── images - * Imagens do projeto devem ir aqui *
	└── jade - * Arquivos templates em jade *
	└── js - * bibliotecas js devem ser colocadas aqui *
	└── sass
├── library
	└── * Arquivos gerados automaticamente *
└── src
	└── * Arquivos de configurações da automação *
```

## Instalando dependências do node
O `package.js` encontra-se na pasta `src`
`$ cd src/`

Instalar as dependências do node
`$ npm install`

### comandos gulp
Os comandos devem ser dados na pasta `src`

 - **padrão**: `$ gulp` 
Compilar todos os arquivos
 
 - **build** `$ gulp build` 
Compilar todos os arquivos
 
 - **release** `$ gulp build --release` 
 Compilar todos os arquivos minificando *js*, *css* e *imagens*
 > A opção `--release` pode ser usada em qualquer um dos comandos `gulp`
 
 - **watch** `$ gulp watch`
Compilar automaticamente quando salvar os arquivos
> Rodar o comando novamente ao adicionar novos arquivos Sass

#### Outros comandos gulp
- **jade** - `$ gulp jade`
> Compilar o jade

- **images** - `$ gulp images`
> colocar as imagens originais na pasta `library/images`

- **styles** - `$ gulp styles`
> compilar o sass

- **coffee** - `$ gulp coffee`
> compilar o coffeescript

- **coffee-libs** - `$ gulp coffee-libs`
> compilar as bibliotecas em coffeescript para a pasta `js/libs`

- **coffee-layout** - `$ gulp coffee-layout`
> compilar os coffeescript referentes ao layout para o arquivo `layout.min.js`

- **libs** - `$ gulp libs`
> colocar as bibliotecas em js para a pasta `library/js/libs`

- **fonts** - `$ gulp fonts`
> colocar as as fonts na pasta `library/fonts`

## Produção
As pastas
```
├── assets
└── src
```
**NÃO** devem ser colocadas no site em produção
