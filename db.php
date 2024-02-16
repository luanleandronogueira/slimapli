<?php
if (PHP_SAPI != 'cli') {
    exit('Rodar via CLI');
}

require __DIR__ . '/vendor/autoload.php';


// Instantiate the app
$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/src/dependencies.php';

$db = $container->get('db');

$schema = $db->schema();
$tabela = 'produtos';

$schema->dropIfExists($tabela);

//cria a tabela produtos
$schema->create($tabela, function($tabela){

    $tabela->increments('id');
	$tabela->string('titulo', 200);
	$tabela->text('descricao');
	$tabela->decimal('preco', 11,2);
    $tabela->string('fabricante', 60);
    $tabela->date('dt_criacao');

});

$db->table($tabela)->insert([

    'titulo' => 'Iphone pro max',
    'descricao' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Impedit placeat modi alias velit possimus',
    'preco' => 4999.99,
    'fabricante' => 'Apple Inc.',
    'dt_criacao' => '2020-01-01'

]);

