<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use App\Models\HealthAttachment;
use App\Models\Attachment;
use App\Models\PaymentAttachment;
use App\Models\Health;
use WireUi\Traits\Actions;
use Livewire\WithFileUploads;
use DB;

class ViewHealthData extends Component
{
    use WithFileUploads;
    use Actions;

    public $record;
    public $health_record;
    public $attachment_id;
    public $transmittal_attachment_id;
    public $payment_attachment_id;
    public $healthModal = false;
    public $transmittalModal = false;
    public $paymentModal = false;
    public $health_attachments = [];
    public $transmittal_attachments = [];
    public $payment_attachments = [];
    protected $listeners = [
        'close_health_modal'=> 'closeHealthModal',
        'close_transmittal_modal'=> 'closeTransmittalModal',
        'close_payment_modal'=> 'closePaymentModal',
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
            $deleted = HealthAttachment::where('id',$this->attachment_id)->first()->delete();
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

    public function deleteTransmittalAttachment($curAtt)
    {
        $this->transmittal_attachment_id = $curAtt;
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => 'Delete attachement? This action cannot be undone',
            'icon'        => 'error',
            'accept'      => [
                'label'  => 'Yes, delete it',
                'method' => 'deleteTransmittalAttachmentFinal',
                'params' => 'Saved',
            ],
            'reject' => [
                'label'  => 'No, cancel',
            ],
        ]);
    }

    public function deleteTransmittalAttachmentFinal()
    {
        $deleted = false;
        if (isset($this->transmittal_attachment_id)) {
            $deleted = Attachment::where('id',$this->transmittal_attachment_id)->first()->delete();
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

    public function deletePaymentAttachment($curAtt)
    {
        $this->attachment_id = $curAtt;
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => 'Delete attachement? This action cannot be undone',
            'icon'        => 'error',
            'accept'      => [
                'label'  => 'Yes, delete it',
                'method' => 'deletePaymentAttachmentFinal',
                'params' => 'Saved',
            ],
            'reject' => [
                'label'  => 'No, cancel',
            ],
        ]);
    }

    public function deletePaymentAttachmentFinal()
    {
        $deleted = false;
        if (isset($this->attachment_id)) {
            $deleted = PaymentAttachment::where('id',$this->attachment_id)->first()->delete();
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

    public function closeHealthModal()
    {
        $this->healthModal = false;
        $this->emit('refreshComponent');
    }

    public function closeTransmittalModal()
    {
        $this->transmittalModal = false;
        $this->emit('refreshComponent');
    }

    public function closePaymentModal()
    {
        $this->paymentModal = false;
        $this->emit('refreshComponent');
    }

    public function mount()
    {
        $this->health_record = Health::find($this->record->id);
    }

    public function render()
    {
        return view('livewire.forms.view-health-data', [
            'record' => $this->record,
        ]);
    }
}
