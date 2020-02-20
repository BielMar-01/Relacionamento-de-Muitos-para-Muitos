<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Projeto;
use App\Desenvolvedor;
use App\Alocacao;

Route::get('/desenvolvedor_projeto', function () {
    
    $desenvolvedores = Desenvolvedor::with('projetos')->get();

    foreach($desenvolvedores as $d) {
        echo "<p> Nome do Desenvolvedor: " . $d->nome . "</p>";
        echo "<p>Cargo: " . $d->cargo . "</p>";
        if(count($d->projetos) > 0) {
            echo "Projetos: <br>";
            echo "<ul>";
            foreach($d->projetos as $p) {
                echo "<li>";
                echo "Nome: " . $p->nome . " | ";
                echo "Horas do Projeto: " . $p->estimativa_horas . " | " ;
                echo "Horas Trabalhadas: " . $p->pivot->horas_semanais;
                echo "</li>";
            }
            echo "</ul>";
        }
        echo "<hr>";
    }
    
    //return $desenvolvedores->toJson();

});

Route::get('/projeto_desenvolvedores', function () {
    $projetos = Projeto::with('desenvolvedores')->get();

    foreach($projetos as $proj) {
        echo "<p> Nome do Projeto: " . $proj->nome . "</p>";
        echo "<p>Estimativa de Horas: " . $proj->estimativa_horas . "</p>";
        if(count($proj->desenvolvedores) > 0) {
            echo "Nome dos Desenvolvedores: <br>";
            echo "<ul>";
            foreach($proj->desenvolvedores as $dev) {
                echo "<li>";
                echo "Informações Gerais: " . $dev->nome . " | ";
                echo "Cargo: " . $dev->cargo . " | " ;
                echo "Horas Trabalhadas: " . $dev->pivot->horas_semanais;
                echo "</li>";
            }
            echo "</ul>";
        }
    }

    // return $projetos->toJson();
});