<section>
    <x-slot name="header">
        {{ __($header) }}
    </x-slot>
    <x-slot name="button">
        @can('slider-list')
            <a href="{{ route('admin.slider.index') }}" wire:navigate>
                <x-button-1 type="button" class="drop-shadow">
                    <x-icon name="arrow-uturn-left" class="w-5 h-5 mr-2" />
                    {!! 'Back' !!}
                </x-button-1>
            </a>
        @endcan
    </x-slot>

    <form wire:submit.prevent="store" class="my-3">

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 ">
            <div class="bg-gray-200 dark:bg-gray-800 space-y-3 p-5">
                <x-input label="Title" type="text" wire:model.defer="form.title" right-icon="document-text" />
                <x-input label="URL" type="url" wire:model.defer="form.link" right-icon="link" />
                <x-native-select wire:model.defer="from.status" id="status"
                                 label="Select Status"
                                 placeholder="Select slider status"
                                 :options="[
    ['name' => 'Active', 'id' => 1, 'description' => 'The status is active'],
    ['name' => 'Inactive', 'id' => 0, 'description' => 'The status is Inactive'],
    ]" option-label="name" option-value="id" />
            </div>

            <div class="bg-gray-200 dark:bg-gray-800 space-y-3 p-5 flex flex-wrap justify-center items-center">

                <div class="flex items-center justify-center  ">
                    <div class="mb-4 p-4 text-sm w-full">
                        <div class="font-bold mb-2">Image</div>
                        <div class="" x-data="previewImage()"
                             wire:loading.class="d-block opacity-20 blur-sm">
                            <x-input-error for="form.image" />

                            <div class="w-full h-66 rounded bg-gray-100 border border-gray-200 flex
                                    items-center justify-center overflow-hidden">

                                <img x-show="imageUrl" :src="imageUrl" class="w-full aspect-video object-contain">
                                <div x-show="!imageUrl" class="text-gray-300 flex flex-col items-center justify-center
                                    w-full aspect-video object-cover">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 " fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <div>Image Preview</div>
                                </div>

                            </div>


                            <div>
                                <label for="logo" class="block mb-2 mt-4 font-bold">Upload image..</label>
                                <x-jet-input class="w-full cursor-pointer" type="file" name="logo" id="logo"
                                             wire:model="form.image" @change="fileChosen" />
                            </div>
                        </div>
                    </div>
                </div>
                <x-button-1 type="submit" class="drop-shadow w-80">
                    <x-icon name="cloud-arrow-up" class="w-5 h-5 mr-2" />
                    {!! 'Save' !!}
                </x-button-1>
            </div>

        </div>

    </form>

</section>
@push('scripts')
    <script>
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
