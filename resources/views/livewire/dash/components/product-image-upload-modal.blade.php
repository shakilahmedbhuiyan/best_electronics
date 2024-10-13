<x-modal-card title="Product Gallery" name="productGallery" persistent>
    <form wire:submit.prevent>
        @csrf
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2" x-data="previewImage()">
            <x-input label="Name" readonly value="{{ $product->name }}" placeholder="{{ $product->name }}" />

            <x-input label="Variation Title" wire:model.defer="variation" placeholder="Image variation title" />

            <div class="col-span-1 sm:col-span-2">
                <x-jet-input label="Email" type="file" wire:model.defer="image" @change="fileChosen"
                             accept="image/jpg,image/jpeg,image/png,image/webp" placeholder="Select Image" />
                <x-input-error for="image" />
            </div>
            <div wire:loading.class="d-block opacity-20 blur-sm"
                 class="flex items-center justify-center col-span-1 bg-gray-100 shadow-md cursor-pointer sm:col-span-2
            dark:bg-secondary-700 rounded-xl h-64">
                <div class="flex flex-col items-center justify-center">
                    <div x-show="!imageUrl" class="mx-auto">
                        <x-icon name="cloud-arrow-up" class="w-16 h-16 text-primary-600 dark:text-teal-600" />
                    </div>
                    <img x-show="imageUrl" :src="imageUrl" class="w-64 aspect-square object-scale-down">

                </div>
            </div>

        </div>


        <x-slot name="footer" class="flex justify-between gap-x-4">
             <x-button flat negative label="Close" x-on:click="close" id="close"/>
            <div class="flex gap-x-4">
                <x-button flat label="Cancel" wire:click="cancel" x-on:click="close" />

                <x-button primary label="Save" wire:click="save" />
            </div>
        </x-slot>
    </form>
</x-modal-card>
@push('scripts')
    <script>
        Livewire.on('productImage', () => {
          document.getElementById('close').click()
        })
        function previewImage() {
            return {
                imageUrl: '',
                fileChosen(event) {
                    this.fileToDataUrl(event, (src) => (this.imageUrl = src))
                },

                fileToDataUrl(event, callback) {
                    if (!event.target.files.length) return

                    let file = event.target.files[0],
                        reader = new FileReader()

                    reader.readAsDataURL(file)
                    reader.onload = (e) => callback(e.target.result)
                },
            }
        }
    </script>
@endpush
