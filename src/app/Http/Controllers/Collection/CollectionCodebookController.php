<?php

namespace App\Http\Controllers\Collection;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCollection;
use App\Http\Requests\UpdateCollection;
use App\Models\Collection;
use Auth;

class CollectionCodebookController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct(
        Collection $collection
    ) {
        $this->collection = $collection;
    }

    public function collection(Collection $collection)
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $section = $phpWord->addSection();

        $description = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse

cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non

proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

        // \PhpOffice\PhpWord\Settings::setZipClass(\PhpOffice\PhpWord\Settings::PCLZIP);

        $section->addText($description);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        try {
            $objWriter->save(storage_path('codebook.docx'));
        } catch (Exception $e) {
        }

        return response()->download(storage_path('codebook.docx'));
    }

    public function text(Collection $collection, Text $text)
    {
        # code...
    }
}
