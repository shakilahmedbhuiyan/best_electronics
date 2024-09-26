<section>
    <x-slot name="button">
        <a href="{{ route('admin.brand.index') }}" wire:navigate>
            <x-button info label="Go Back" icon="arrow-uturn-left" outline hover="info"
                      class="leading-loose !py-1  uppercase text-gray-700 dark:text-gray-200" />
        </a>
    </x-slot>

    <div class="my-2">
        <x-card>

            <form wire:submit.prevent="store" class="space-y-4">
                <div
                    class="flex flex-col sm:flex-row justify-center items-center w-full sm:space-x-2 sm:space-y-0 space-y-4">
                    <div for="name" label="Name" :error="$errors->first('name')" class="w-full sm:w-1/2">
                        <x-input wire:model.defer="name" id="name" placeholder="Enter brand name" />
                    </div>

                    <div for="slug" label="Slug" :error="$errors->first('slug')" class="w-full sm:w-1/2">
                        <x-input wire:model.defer="slug" id="slug" placeholder="Enter brand slug" />
                    </div>
                </div>

                <div for="description" label="Description" :error="$errors->first('description')">
                    <x-textarea wire:model.defer="description" id="description"
                                placeholder="Enter brand description" />
                </div>

                <div class="flex flex-col sm:flex-row justify-around items-start space-x-2 w-full ">
                    <div for="status" label="Status" :error="$errors->first('status')" class="w-full sm:w-2/6 ">
                        <x-native-select wire:model.defer="status" id="status"
                                         label="Select Status"
                                         placeholder="Select Brand status"
                                         :options="[
    ['name' => 'Active', 'id' => 1, 'description' => 'The status is active'],
    ['name' => 'Inactive', 'id' => 0, 'description' => 'The status is Inactive'],
]" option-label="name" option-value="id" />
                    </div>

                    <div class="flex items-center justify-center  ">
                        <div class="mb-4 p-4 text-sm w-full">
                            <div class="font-bold mb-2">Brand Logo</div>
                            <div class="" x-data="previewImage()"
                                 wire:loading.class="d-block opacity-20 blur-sm">
                                <x-input-error for="thumbnail" />

                                <label for="logo">
                                    <div class="w-44 h-44 rounded bg-gray-100 border border-gray-200 flex
                                    items-center justify-center overflow-hidden">

                                        <img x-show="imageUrl" :src="imageUrl" class="w-full object-cover">
                                        <div x-show="!imageUrl" class="text-gray-300 flex flex-col items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 " fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <div>Image Preview</div>
                                        </div>

                                    </div>
                                </label>

                                <div>
                                    <label for="logo" class="block mb-2 mt-4 font-bold">Upload image..</label>
                                    <input class="w-full cursor-pointer" type="file" name="logo" id="logo"
                                           wire:model="thumbnail" @change="fileChosen">
                                </div>
                            </div>
                        </div>
                    </div>
                    8

                </div>


                <x-button info type="submit" label="Create Brand" icon="plus" />
            </form>
        </x-card>
    </div>

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
