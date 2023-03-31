<div>
  <div>
    <div class="flex flex-col border p-2 space-y-1 mb-1">
      <label for="member">member</label>
      <input type="file" wire:model="member">
    </div>
    <x-button label="Upload" wire:click="uploadMember" dark spinner="  member" />
  </div>
  <div class="mt-1">
    <div class="flex flex-col border p-2 space-y-1 mb-1">
      <label for="member">Health death</label>
      <input type="file" wire:model="health">
    </div>
    <x-button label="Upload" wire:click="uploadHealth" spinner="health" dark />
  </div>
  <div class="mt-1">
    <div class="flex flex-col border p-2 space-y-1 mb-1">
      <label for="member">Death</label>
      <input type="file" wire:model="death">
    </div>
    <x-button label="Upload" wire:click="uploadDeath" spinner="death" dark />
  </div>
</div>
