<div>
    <form wire:submit.prevent="save" class="grid grid-cols-1">
        <div>
            <div class="flex items-center">
                <div class="flex-shrink-0 h-6 w-6">
                    <svg class="h-6 w-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M16 10v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6H1.586A2 2 0 013 9.414L10 2.414l7 7a2 2 0 01-.586 2.828H16z">
                        </path>
                    </svg>
                </div>
                <label for="audioFile" class="block ml-3 text-sm font-medium text-gray-700">Sube tu archivo de
                    audio</label>
            </div>
            <div wire:ignore>
                <input type="file" id="audioFile" class="filepond" name="audio">
            </div>
            <!-- Error message displayed below the file input -->
            @error('dataAudio')
                <div class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="flex justify-center mt-4">
            <button type="submit"
                class="py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <span wire:loading.remove wire:target='save'>Procesar</span>
                <span wire:loading wire:target='save'>Loading...</span>
            </button>
        </div>
    </form>
</div>
