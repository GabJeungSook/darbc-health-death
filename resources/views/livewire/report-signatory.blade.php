<div>
    <div class="flex justify-between">
        <div>
            <x-button label="Back" class="font-bold" icon="arrow-left" positive  wire:click="redirectToHealth" />
          </div>
    </div>
    <div class="mt-4">
        {{$this->table}}
    </div>
</div>
