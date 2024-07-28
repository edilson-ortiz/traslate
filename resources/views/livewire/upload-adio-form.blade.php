<div>
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-lg">
        <form wire:submit.prevent="save" class="grid grid-cols-3 gap-4">
            <div class="col-span-1">
                <label for="audioName" class="block text-sm font-medium text-gray-700">Nombre del Audio</label>
                <input type="text" id="audioName" wire:model="name" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('audioName')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-1">
                <label for="audioFile" class="block text-sm font-medium text-gray-700">Archivo de Audio</label>
                <input type="file" id="audioFile" wire:model="audio"
                    class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" accept=".mp3, .m4a">
                @error('audioFile')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-1 mt-4">
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Subir Audio
                </button>
            </div>

            @if (session()->has('message'))
                <div class="col-span-2 mt-4">
                    <p class="text-green-500">{{ session('message') }}</p>
                </div>
            @endif
        </form>
    </div>

</div>
