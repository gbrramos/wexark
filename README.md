# Teste Prático Back End PHP WexArk - Feito em LARAVEL

<h3>Desenvolvido por: Gabriel Ramos Oliveira</h3>

<h3>Objetivo</h3>
<p>Desenvolver uma API RESTful para o gerenciamento de uma pastelaria, utilizando PHP ou qualquer framework da linguagem.</p>

<h3>Como usar</h3>
<p>A API é baseada em 3 rotas, sendo elas:</p>
<ul>
    <li>/api/clientes</li>
    <li>/api/pedidos</li>
    <li>/api/pasteis</li>
</ul>
<p>É bom notar que as 3 rotas tem o prefixo /api antes do nome</p>
<p>Por ser uma API RESTful, para cada rota é preciso usar os metodos HTTP (GET para pegar, POST para cadastrar, PUT para editar e DELETE para deletar).</p>
<p>Para se pegar ou editar um item específico do banco de dados a rota teria o sufixo ID no final</p>
<p>Ficaria por exemplo: '/api/pedidos/1' (Metodo GET para exibir-se os dados, PUT para editar o pedido de ID 1 ou DELETE para deletar o pedido de ID 1)</p>
<p>No caso, o 1 seria o ID do pedido</p>
<hr>
<h3>Parâmetros</h3>
<p><strong>Para se cadastrar ou editar um cliente é necessário passar os seguintes parâmetros</strong></p>
<ul>
    <li>nome</li>
    <li>email</li>
    <li>data_nascimento</li>
    <li>endereco</li>
    <li>bairro</li>
    <li>cep</li>
    <li>complemento (opcional)</li>
    <li>data_cadastro</li>
</ul> 
<hr>
<p><strong>Para se cadastrar ou editar um pedido é necessário passar os seguintes parâmetros</strong></p>
<ul>
    <li>cliente_id (a API espera que o software externo identifique o ID do cliente) </li>
    <li>data_criacao</li>
    <li>pastel (este pode ser um array com vários pasteis)</li>
</ul> 
<hr>
<p><strong>Para se cadastrar ou editar um pastel é necessário passar os seguintes parâmetros</strong></p>
<ul>
    <li>nome</li>
    <li>preco (este precisa ser um número)</li>
    <li>media (imagem)</li>
</ul> 
<hr>
<h3>Como executar a API</h3>
<p>Após clonar o repositório é necessário instalar as migrações e o seeder no banco de dados</p>

```bash
   php artisan migrate --seed
```
<p>Ou</p>

```bash
   php artisan migrate:refresh --seed
```

<p>Para se executar a API é necessário usar o comando</p>

```bash
   php artisan serve
```

<p>Depois disso, é só usar as rotas em combinação com os métodos HTTP para fazer as operações de um CRUD.</p>
<p>Atenção: O sistema de envio de emails só funcionará caso o sistema esteja rodando em um servidor com o serviço de email configurado. </p>
