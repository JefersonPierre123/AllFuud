<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/verify-cpf', function(Request $request) {
    $cpf = preg_replace('/\D/', '', $request->query('cpf'));
    if (strlen($cpf) !== 11) {
        return response()->json(['error' => 'CPF inválido'], 422);
    }
    $resp = Http::withOptions([
        'verify' => false,
    ])->get("https://www.receitaws.com.br/v1/cpf/{$cpf}");
    return response()->json($resp->json());
});

Route::get('/verify-cnpj', function(Request $request) {
    $cnpj = preg_replace('/\D/', '', $request->query('cnpj'));
    if (strlen($cnpj) !== 14) {
        return response()->json(['error' => 'CNPJ inválido'], 422);
    }
    $resp = Http::withOptions([
        'verify' => false,
    ])->get("https://www.receitaws.com.br/v1/cnpj/{$cnpj}");
    return response()->json($resp->json());
});

// Route::get('/verify-cep', function(Request $request) {
//     $cep = preg_replace('/\D/', '', $request->query('cep'));
//     if (strlen($cep) !== 8) {
//         return response()->json(['error' => 'CEP inválido'], 422);
//     }
//     $resp = Http::withOptions([
//         'verify' => false,
//     ])->get("https://viacep.com.br/ws/${cep}/json/");
//     return response()->json($resp->json());
// });

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

?>