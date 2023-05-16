<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use App\Models\MortuaryAttachment;
use App\Models\Mortuary;
use WireUi\Traits\Actions;
use Livewire\WithFileUploads;
use DB;

class ViewMortuaryData extends Component
{
    use WithFileUploads;
    use Actions;

    public $record;
    public $mortuary_record;
    public $attachment_id;
    public $mortuaryModal = false;
    public $mortuary_attachments = [];

    protected $listeners = [
        'close_mortuaries_modal'=> 'closeMortuaryModal',
        'refreshComponent' => '$refresh'
    ];

    public function getFileUrl($filename)
    {
        return Storage::url($filename);
    }

    public function deleteAttachment($curAtt)
    {
        $this->attachment_id = $curAtt;
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => 'Delete attachement? This action cannot be undone',
            'icon'        => 'error',
            'accept'      => [
                'label'  => 'Yes, delete it',
                'method' => 'deleteAttachmentFinal',
                'params' => 'Saved',
            ],
            'reject' => [
                'label'  => 'No, cancel',
            ],
        ]);
    }

    public function deleteAttachmentFinal()
    {
        $deleted = false;
        if (isset($this->attachment_id)) {
            $deleted = MortuaryAttachment::where('id',$this->attachment_id)->first()->delete();
        }
       if ($deleted) {
        $this->dialog()->success(
            $title = 'Success',
            $description = 'Attachment has been deleted'
        );
       } else {
        $this->dialog()->error(
            $title = 'An error occured!',
            $description = 'Reload the page and try again!'
        );
       }
       $this->emit('refreshComponent');
    }

    public function mount()
    {
        $this->death_record = Mortuary::find($this->record->id);
    }

    public function closeMortuaryModal()
    {
        $this->mortuaryModal = false;
        $this->emit('refreshComponent');
    }


    public function render()
    {
        return view('livewire.forms.view-mortuary-data');
    }
}
