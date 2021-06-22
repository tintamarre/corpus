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
        // To allow `&` in variable
        \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle->setBold(true);
        $fontStyle->setName('Open Sans');
        $fontStyle->setSize(10);

        $properties = $phpWord->getDocInfo();
        $properties->setCreator('Corpus');
        $properties->setCompany('Corpus from ULiège');
        $properties->setTitle('Corpus');
        $properties->setDescription('Corpus export');
        

        $phpWord->getSettings()->setUpdateFields(true);

        // New section
        $section = $phpWord->addSection();
        $header = $section->addHeader();
        $header->addWatermark(storage_path('app/public/logo.png'), ['marginBottom' => 20, 'marginRight' => 15, 'width' => 30,
        'height' => 30]);

        $phpWord->addParagraphStyle('pStyler', ['align' => 'right']);
        $textrun = $header->addTextRun('pStyler');

        $textrun->addText(date('Ymd H:i:s'), ['size' => 8, 'color' => '#666666']);
 
        $footer = $section->addFooter();
        $textrun = $footer->addTextRun('pStyler');
        $textrun->addText('Exported from https://corpus.lltl.be', ['size' => 8, 'color' => '#666666', 'italic' => true]);

        // Define styles
        $fontStyle12 = ['spaceAfter' => 60, 'size' => 12];
        $fontStyle10 = ['size' => 10];

        $phpWord->addTitleStyle(null, ['size' => 22, 'color' => '#344c77', 'bold' => true]);
        $phpWord->addTitleStyle(1, ['size' => 20, 'color' => '#344c77', 'bold' => true]);
        $phpWord->addTitleStyle(2, ['size' => 14, 'color' => '#666666', 'bold' => true]);
        $phpWord->addTitleStyle(3, ['size' => 12, 'italic' => true]);
        $phpWord->addTitleStyle(4, ['size' => 12]);

        $section->addTitle($collection->name, 0);

        $section->addText('Description '. $collection->description);

        $section->addTitle('Texts', 1);

        $tableStyle = [
            'borderColor' => '#cccccc',
            'borderSize'  => 6,
            'cellMargin'  => 50
        ];
        $firstRowStyle = ['bgColor' => '#344c77', 'color' => '#FFFFFF', 'bold' => true];
        $phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
        $table = $section->addTable('myTable');
        $table->addRow();
        $table->addCell()->addText('#', $firstRowStyle);
        $table->addCell()->addText('Title', $firstRowStyle);
        $table->addCell()->addText('Abstract', $firstRowStyle);
        $table->addCell()->addText('Reading estimate', $firstRowStyle);
        $table->addCell()->addText('Tagging estimate', $firstRowStyle);
        $table->addCell()->addText('Updated', $firstRowStyle);

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
            if ($tag->snippets->count() >= 1) {
                $section->addTitle('🏷️ '. $tag->name, 2);
                $section->addText($tag->snippets->count() . ' occurrences', ['size' => 8, 'color' => '#666666', 'name' => 'Arial']);
                $section->addTextBreak();
    
                foreach ($tag->snippets as $snippet) {
                    $textrun = $section->addTextRun();
    
                    $before_snippet = mb_substr($snippet['segment_content'], $snippet['snippet_start'] <= 50 ? 0 : $snippet['snippet_start'] - 50, $snippet['snippet_start'] <= 50 ? $snippet['snippet_start'] : 50);
                    $after_snippet = mb_substr($snippet['segment_content'], $snippet['snippet_end'], $snippet['snippet_end'] + 50 >= mb_strlen($snippet['segment_content']) ? mb_strlen($snippet['segment_content']) - $snippet['snippet_end'] : 50);
                    
                    $this->nl2wbr('... ' . $before_snippet, $textrun, []);
                    $this->nl2wbr($snippet['snippet_content'], $textrun, ['bgColor' => '#FFFF00']);
                    $this->nl2wbr($after_snippet . ' ...', $textrun, []);
                    
                    $textrun->addTextBreak();

                    $textrun = $section->addTextRun('pStyler');
                    $textrun->addText('from ', ['size' => 8, 'color' => '#cccccc']);

                    $textrun->addLink($snippet['text']['links']['self'], $snippet['text']['name'], ['size' => 8, 'color' => '#666666', 'underline' => 'single']);


                    $textrun->addTextBreak();
                }
                $textrun->addTextBreak();
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

    private function nl2wbr($string, $textrun, $style)
    {
        $textlines = explode("\n", $string);
  
        foreach ($textlines as $key => $line) {
            if ($key >= 1) {
                $textrun->addTextBreak();
            }
            $textrun->addText($line, $style);
        }
    }
}
