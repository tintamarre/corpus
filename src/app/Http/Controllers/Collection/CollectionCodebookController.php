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
        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle->setBold(true);
        $fontStyle->setName('Tahoma');
        $fontStyle->setSize(10);

        $properties = $phpWord->getDocInfo();
        $properties->setCreator('Corpus');
        $properties->setCompany('Corpus');
        $properties->setTitle('Corpus');
        $properties->setDescription('Corpus export');
        
        $phpWord->getSettings()->setUpdateFields(true);

        // New section
        $section = $phpWord->addSection();

        // Define styles
        $fontStyle12 = array('spaceAfter' => 60, 'size' => 12);
        $fontStyle10 = array('size' => 10);

        $phpWord->addTitleStyle(null, ['size' => 22, 'bold' => true]);
        $phpWord->addTitleStyle(1, ['size' => 20, 'color' => '0171c5', 'bold' => true]);
        $phpWord->addTitleStyle(2, ['size' => 16, 'color' => '666666', 'bold' => true, 'underline' => 'single']);
        $phpWord->addTitleStyle(3, ['size' => 14, 'italic' => true]);
        $phpWord->addTitleStyle(4, ['size' => 12]);

        $section->addTitle($collection->name, 0);

        $section->addPageBreak();
        // Add text elements
        $section->addTitle('Table of contents', 0);
        $section->addTextBreak(2);

        // Add TOC
        $toc = $section->addTOC($fontStyle12);
        $section->addTextBreak(2);

        $section = $phpWord->addSection();

        $section->addTitle($collection->name, 1);
        $section->addText($collection->description);

        $section->addText(now());

        $section->addTitle('List of texts from Corpus ' . $collection->name, 1);
        foreach ($collection->texts as $key => $text) {
            $section->addTitle($text->name, 2);
            $section->addTextBreak(1);
        }

        $section->addTitle('List of tags from Corpus ' . $collection->name, 1);
        foreach ($collection->tags as $key => $tag) {
            $section->addTitle($tag->name, 2);
            foreach ($tag->snippets as $snippet) {
                $section->addText($snippet['snippet_content']);
                $section->addTextBreak(1);
                $section->addText($snippet['text']['name'], ['size' => 8, 'color' => 'ccc', 'underline' => 'single', 'rtl' => 'right' ]);
                $section->addTextBreak(2);
            }
        }
        
        // $section->addText('Lead text.');
        // $footnote = $section->addFootnote();
        // $footnote->addText('Footnote text.');

        // Saving the document as OOXML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        $filename = 'exports/' . $collection->slug . '_codebook.docx';

        try {
            $objWriter->save(storage_path($filename));
        } catch (Exception $e) {
        }

        return response()->download(storage_path($filename));
    }

    public function text(Collection $collection, Text $text)
    {
        # code...
    }
}
