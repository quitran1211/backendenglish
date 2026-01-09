<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DictionaryController extends Controller
{
    public function search(Request $request)
    {
        $word = trim($request->query('word'));
        $mode = $request->query('mode', 'en-vi'); // en-vi | vi-en

        if (! $word) {
            return response()->json([
                'message' => 'Missing word parameter',
            ], 400);
        }

        $cacheKey = "dictionary_{$mode}_".md5($word);

        return Cache::remember($cacheKey, 86400, function () use ($word, $mode) {

            /* ================= 1. VI → EN ================= */
            $englishWord = $word;

            if ($mode === 'vi-en') {
                $englishWord = $this->translate($word, 'vi', 'en');
            }

            /* ================= 2. DICTIONARY API ================= */
            $dictRes = Http::timeout(10)
                ->get("https://api.dictionaryapi.dev/api/v2/entries/en/{$englishWord}");

            if ($dictRes->failed()) {
                return response()->json([
                    'word' => $englishWord,
                    'message' => 'Không tìm thấy từ',
                ], 404);
            }

            $dictData = $dictRes->json()[0];

            /* ================= 3. EN → VI ================= */
            $viMeaning = $this->translate($dictData['word'], 'en', 'vi');

            /* ================= 4. NORMALIZE ================= */
            return [
                'word' => $dictData['word'],
                'phonetic' => $dictData['phonetic'] ?? null,
                'audio' => collect($dictData['phonetics'] ?? [])
                    ->pluck('audio')
                    ->filter()
                    ->first(),
                'meaning_vi' => $viMeaning,
                'meanings' => collect($dictData['meanings'] ?? [])
                    ->map(function ($m) {
                        return [
                            'part_of_speech' => $m['partOfSpeech'] ?? null,
                            'definitions' => collect($m['definitions'] ?? [])
                                ->map(fn ($d) => [
                                    'definition' => $d['definition'] ?? null,
                                    'example' => $d['example'] ?? null,
                                ])
                                ->values(),
                        ];
                    })
                    ->values(),
            ];
        });
    }

    /* ================= TRANSLATE ================= */
    protected function translate(string $text, string $from, string $to): string
    {
        $res = Http::timeout(10)->get(
            'https://api.mymemory.translated.net/get',
            [
                'q' => $text,
                'langpair' => "{$from}|{$to}",
            ]
        );

        return $res->json()['responseData']['translatedText'] ?? '';
    }
}
