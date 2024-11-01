=== Vitrine Mercado Livre ===
Contributors: wordpresslivro
Donate link: http://wordpresslivro.com
Tags: mercadolivre, vitrine, galeria, loja, mercadosocio, xml mercado livre, vitrine mercado livre
Requires at least: 2.0.2
Tested up to: 2.3
Stable tag: 1.0

Exibe uma vitrine do Mercado Livre em seu Blog, pr&oacute;prio para Afiliados do Mercado Livre

== Description ==

Este plugin permite a afiliados do Mercado Livre exibirem produtos do mercado livre em forma de vitrine em seu blog
&Eacute; poss&iacute;vel configurar a quantidade m&aacute;xima de produtos a serem exibidas, categoria, palavra chave para busca, pre&ccedil;o m&iacute;nimo e pre&ccedil;o m&aacute;ximo ou exibir os mais vendidos.

== Installation ==

Siga esses passos para fazer a instala&ccedil;&atilde;o e configura&ccedil;&atilde;o do Plugin:
1- Abra o arquivo config.php e preencha as devidas informa&ccedil;&otilde;es, veja:
$tool_id         = "";  //ID da Ferramenta (ID da campanha no Mercado Livre)

$as_qshow        = ""   //Quantidade de Produtos para exibir na Vitrine;
$as_categ_id     = "";  //N&uacute;mero de uma Categoria. Se informado exibir&aacute; somente produtos dessa categoria
$as_word         = "";  //Nome do Produto a ser Buscado
$as_price_min    = "";  //Pre&ccedil;o M&iacute;nimo no formato (000.00). Se informado s&oacute; exibir&aacute; produtos com pre&ccedil;o superior a esse valor
$as_price_max    = "";  //Pre&ccedil;o M&aacute;ximo no formato (000.00). Se informado s&oacute; exibir&aacute; produtos com pre&ccedil;o inferior a esse valor

Para que a galeria exiba os mais vendidos basta deixar a categoria e a palavra chave sem preencher.

2- Salve as altera&ccedil;&otilde;es e envie a pasta do plugin para o servidor remoto onde o seu blog est&aacute; instalado. O plugin deve ser enviado para o diret&oacute;rio de plugins que fica em /wp-content/plugins/
3- Acesse o painel do blog e ative o Plugin Vitrine Mercado Livre
4- Agora &eacute; s&oacute; criar um Post e colocar o c&oacute;digo:
[vitrine]palavra chave[/vitrine] 
Note que palavra chave &eacute; o termo que ser&aacute; utilizado na busca que ser&aacute; feita no Mercado Livre. Note ainda que se voc&ecirc; deixar esse campo sem preencher, o sistema ir&aacute; utilizar a palavra chave padr&atilde;o que voc&ecirc; informou no arquivo config.php, como foi visto na etapa 1.
5- Isso &eacute; tudo, agora &eacute; s&oacute; publicar o post ou atualizar ele e visualizar sua vitrine.

== License ==

This file is part of Vitrine Mercado Livre.
Vitrine Mercado Livre is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published
by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
Vitrine Mercado Livre is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with Vitrine Mercado Livre. If not, see <http://www.gnu.org/licenses/>.

== Frequently Asked Questions ==

= Posso Sugerir algo para o plugin? =
Claro que sim, para isso visite o url [Plugin Vitrine Mercado Livre](http://wordpresslivro.com/plugin-vitrine-mercado-livre#comments)

== Screenshots ==

1. Imagem da Vitrine Mercado Livre

== Changelog ==

= 1.0 =
* Adicionado o recurso para exibir o valor parcelado
* Adicionado o recurso para exibir os mais vendidos