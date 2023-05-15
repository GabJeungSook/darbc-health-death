<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use App\Models\Health;
use WireUi\Traits\Actions;
use DB;


class UplaodTransmittalAttachments extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use Actions;

    public $health_id;
    public $health;
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
            $this->health->transmittals->attachments()->create(
                [
                     "path"=>'public/'.now()->format("HismdY-").$file->getClientOriginalName(),
                     "document_name"=>$file->getClientOriginalName(),
                ]
            );
        }
        DB::commit();

        $this->dialog()->success(
            $title = 'Success',
            $description = 'Attachment has been added'
        );
        $this->emit('close_transmittal_modal');
    }

    public function mount()
    {
        $this->health = Health::find($this->health_id);
    }

    public function render()
    {
        return view('livewire.forms.uplaod-transmittal-attachments');
    }
}
