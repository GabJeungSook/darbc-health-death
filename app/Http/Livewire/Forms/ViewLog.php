<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use App\Models\ReportSignatory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class ViewLog extends Component
{
    public $record;

    public function downloadToWord()
    {
         // Get the content to export from the blade file
         $contentToExport = view('exports.log-word-export', [
            'record' => $this->record,
            'signatory' => ReportSignatory::where('report_id', 3)->first(),
        ])->render();

         // Create a new PhpWord instance
         $phpWord = new PhpWord();
         $section = $phpWord->addSection();

         // Add the HTML content of the specific div to the PhpWord object
         \PhpOffice\PhpWord\Shared\Html::addHtml($section, $contentToExport, false, false);

         // Save the PhpWord object to a Word file
         $filename = strtoupper($this->record->last_name) . ', ' . strtoupper($this->record->first_name) . ' ' . strtoupper($this->record->middle_name).'-LOG.docx';
         $filePath = storage_path('app/' . $filename);
         $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
         $objWriter->save($filePath);

         // Provide the download response
         return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function render()
    {
        return view('livewire.forms.view-log', [
            'record' => $this->record,
            'signatory' => ReportSignatory::where('report_id', 3)->first(),
        ]);
    }
}
