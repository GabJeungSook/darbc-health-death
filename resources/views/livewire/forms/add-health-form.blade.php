<div>
{{$this->form}}
<div class="mt-4 flex justify-between">
    <div class=""></div>
    <div>
        <x-button primary label="Cancel" wire:click="closeModal" spinner="closeModal"/>
        <x-button primary label="Save" wire:click="save" spinner="save"/>
    </div>

</div>
</div>
