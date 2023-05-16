<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use App\Models\Mortuary;
use WireUi\Traits\Actions;
use DB;

class UploadMortuaryAttachments extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use Actions;

    public $mortuary_id;
    public $mortuary;
    public $attachment = [];

    protected function getFormSchema(): array
    {
        return [
            FileUpload::make('attachment')
                        ->enableOpen()
                        ->multiple()
                        ->disk('public')
                        ->preserveFilenames()
                        ->required()
                        ->reactive()
        ];
    }

    public function save()
    {
        DB::beginTransaction();
        foreach ($this->attachment as $file) {
            $this->mortuary->mortuary_attachments()->create(
                [
                     "path"=>$file->storeAs('public',now()->format("HismdY-").$file->getClientOriginalName()),
                    "document_name"=>$file->getClientOriginalName(),
                ]
            );
        }
        DB::commit();

        $this->dialog()->success(
            $title = 'Success',
            $description = 'Attachment has been added'
        );
        $this->emit('close_mortuaries_modal');
    }

    public function mount()
    {
        $this->mortuary = Mortuary::find($this->mortuary_id);
    }


    public function render()
    {
        return view('livewire.forms.upload-mortuary-attachments');
    }
}
