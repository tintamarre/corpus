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
        $fontStyle12 = ['spaceAfter' => 60, 'size' => 12];
        $fontStyle10 = ['size' => 10];

        $phpWord->addTitleStyle(null, ['size' => 22, 'bold' => true]);
        $phpWord->addTitleStyle(1, ['size' => 20, 'color' => '#0171c5', 'bold' => true]);
        $phpWord->addTitleStyle(2, ['size' => 16, 'color' => '#666666', 'bold' => true, 'underline' => 'single']);
        $phpWord->addTitleStyle(3, ['size' => 14, 'italic' => true]);
        $phpWord->addTitleStyle(4, ['size' => 12]);

        $section->addTitle($collection->name, 0);

        $section->addText($collection->description);

        $section->addText('Exported from Corpus at ' . now());


        $section->addTitle('Texts from ' . $collection->name, 1);

        $tableStyle = [
            'borderColor' => '#cccccc',
            'borderSize'  => 6,
            'cellMargin'  => 50
        ];
        $firstRowStyle = ['bgColor' => '#344c77', 'color' => '#FFFFFF', 'bold' => true];
        $phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
        $table = $section->addTable('myTable');
        $table->addRow();
        $table->addCell()->addText('#');
        $table->addCell()->addText('Title');
        $table->addCell()->addText('Abstract');
        $table->addCell()->addText('Reading estimate');
        $table->addCell()->addText('Tagging estimate');
        $table->addCell()->addText('Updated');

        foreach ($collection->texts as $key => $text) {
            $table->addRow();
            $table->addCell()->addText($key + 1);
            $table->addCell()->addText($text->name);
            $table->addCell()->addText($text->abstract);
            $table->addCell()->addText($text->stats['reading_estimate']['value']);
            $table->addCell()->addText($text->stats['tagging_estimate']['value']);
            $table->addCell()->addText($text->updated_at);
        }

        $section->addPageBreak();
        // Add text elements
        $section->addTitle('Table of contents', 0);
        $section->addTextBreak(2);

        // Add TOC
        $toc = $section->addTOC($fontStyle12);
        $section->addTextBreak(2);
    

        $section = $phpWord->addSection();
        $section->addTitle('Codebook of ' . $collection->name, 1);
        foreach ($collection->tags as $key => $tag) {
            $section->addTitle($tag->name, 2);
            foreach ($tag->snippets as $snippet) {
                $textrun = $section->addTextRun();

                $before_snippet = mb_substr($snippet['segment_content'], $snippet['snippet_start'] <= 50 ? 0 : $snippet['snippet_start'] - 50, $snippet['snippet_start'] <= 50 ? $snippet['snippet_start'] : 50);
                $after_snippet = mb_substr($snippet['segment_content'], $snippet['snippet_end'], $snippet['snippet_end'] + 50 >= mb_strlen($snippet['segment_content']) ? mb_strlen($snippet['segment_content']) - $snippet['snippet_end'] : 50);
                $textrun->addText(' [...] ');
                $textrun->addText($before_snippet);
                $textrun->addText($snippet['snippet_content'], ['bgColor' => '#FFFF00']);
                $textrun->addText($after_snippet);
                $textrun->addText(' [...] ');
                $textrun->addTextBreak(1);
                $textrun->addText($snippet['text']['name'], ['size' => 8, 'color' => '#666666', 'underline' => 'single']);
                $textrun->addTextBreak(2);
            }
        }
        
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
