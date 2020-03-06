<?php

Route::get('/', function () {
    return view('template.app');
});


Route::group(["prefix" => "funcionarios"], function () {
    Route::get('/', function () {
        return redirect('/funcionarios/home');
    });
    Route::get("/novo", "FuncionariosController@novoView");
    Route::get("/{cod}/editar", "FuncionariosController@editarView");
    Route::get("/{cod}/excluir", "FuncionariosController@excluirView");
    Route::get("/{cod}/destroy", "FuncionariosController@destroy");
    Route::post("/store", "FuncionariosController@store");
    Route::post("/update", "FuncionariosController@update");
    Route::post("/busca", "FuncionariosController@busca");
    Route::get("/{letra}", "FuncionariosController@index");
});