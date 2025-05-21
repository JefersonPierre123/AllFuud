<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** 
     * Apenas para teste
     * 
    */
        $establishments = [
            [
                'image' => 'establishment-image-placeholder.jpg',
                'title' => 'Pizzaria da Vó',
                'description' => 'A melhor pizza artesanal do bairro com fermentação natural.',
                'classification' => 4.8,
            ],
            [
                'image' => 'establishment-image-placeholder.jpg',
                'title' => 'Sushi Express',
                'description' => 'Sushis e temakis preparados na hora com ingredientes frescos.',
                'classification' => 4.5,
            ],
            [
                'image' => 'establishment-image-placeholder.jpg',
                'title' => 'Burguer do Zé',
                'description' => 'Hambúrgueres artesanais com blend especial da casa.',
                'classification' => 4.3,
            ],
            [
                'image' => 'establishment-image-placeholder.jpg',
                'title' => 'Veg & Go',
                'description' => 'Comida vegana saudável e deliciosa para todos os gostos.',
                'classification' => 4.7,
            ],
            [
                'image' => 'establishment-image-placeholder.jpg',
                'title' => 'Churrasco Grill',
                'description' => 'Rodízio completo com cortes nobres e buffet livre.',
                'classification' => 4.6,
            ],
        ];

        $products = [
        [
            'image' => 'food-image-placeholder.jpg',
            'title' => 'Feijoada Completa',
            'description' => 'Tradicional prato brasileiro com feijão preto, carnes defumadas e acompanhamentos.',
            'price' => 'R$ 39,90',
        ],
        [
            'image' => 'food-image-placeholder.jpg',
            'title' => 'Lasanha à Bolonhesa',
            'description' => 'Camadas de massa com molho de carne, queijo e molho bechamel gratinado.',
            'price' => 'R$ 34,90',
        ],
        [
            'image' => 'food-image-placeholder.jpg',
            'title' => 'Combo Sushi 20 Peças',
            'description' => 'Seleção de sushis e sashimis variados com molho shoyu e gengibre.',
            'price' => 'R$ 49,90',
        ],
        [
            'image' => 'food-image-placeholder.jpg',
            'title' => 'Hambúrguer Artesanal',
            'description' => 'Pão brioche, carne premium, queijo cheddar, bacon crocante e maionese da casa.',
            'price' => 'R$ 29,90',
        ],
        [
            'image' => 'food-image-placeholder.jpg',
            'title' => 'Salada Grega',
            'description' => 'Alface, tomate, pepino, cebola roxa, azeitonas e queijo feta temperados com azeite.',
            'price' => 'R$ 24,90',
        ],
    ];
    //  return view('welcome', [
    //         'establishments' => $establishments,
    //         'products' => $products,
    //     ]);
        return view('welcome', compact('establishments', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
