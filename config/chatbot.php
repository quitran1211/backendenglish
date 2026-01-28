<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Groq Configuration
    |--------------------------------------------------------------------------
    */
    'groq' => [
        'api_key' => env('GROQ_API_KEY'),
        'model' => 'llama-3.1-8b-instant',
    ],

    /*
    |--------------------------------------------------------------------------
    | ChromaDB Configuration
    |--------------------------------------------------------------------------
    */
    'chroma' => [
        'url' => env('CHROMA_DB_URL', 'http://localhost:8000'),
        'collection_name' => 'toeic_knowledge',
    ],

    /*
    |--------------------------------------------------------------------------
    | Embedding Model
    |--------------------------------------------------------------------------
    */
    'embedding' => [
        'model' => 'sentence-transformers/paraphrase-multilingual-MiniLM-L12-v2',
        'api_url' => env('EMBEDDING_API_URL', 'http://localhost:8001'), // Python service
    ],

    /*
    |--------------------------------------------------------------------------
    | Chat Settings
    |--------------------------------------------------------------------------
    */
    'chat' => [
        'max_history' => 20,
        'context_window' => 5,
        'rate_limit' => [
            'enabled' => true,
            'max_requests' => 10,
            'per_minutes' => 1,
        ],
    ],

];
