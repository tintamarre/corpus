<?php

namespace App\Http\Controllers\Collection;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCollection;
use App\Http\Requests\UpdateCollection;
use App\Models\Collection;
use App\Models\Text;

use Auth;

class CollectionTextsAnalysisController extends Controller
{
    public function text(Collection $collection, Text $text)
    {
        $text = $text->segments->pluck('content');
        $tokens = tokenize($text, \TextAnalysis\Tokenizers\PennTreeBankTokenizer::class);
        $normalizedTokens = normalize_tokens($tokens, 'mb_strtolower');
        $freqDist = freq_dist($tokens);
        $bigrams = ngrams($tokens);

        return response()->json([
            'text' => $text,
            'normalizedTokens' => $normalizedTokens,
            'freq' => $freqDist,
            'bigrams' => $bigrams,
        ]);
    }
}
