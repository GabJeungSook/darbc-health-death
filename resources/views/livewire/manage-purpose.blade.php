<div>
    <div class="flex justify-between">
        <div>
            <x-button label="Back" class="font-bold mb-3" icon="arrow-left" positive  wire:click="redirectToCommunityRelation" />
          </div>
    </div>
    <span class="font-semibold">Purpose</span>
    <div class="mt-4">
        {{$this->table}}
    </div>
</div>
