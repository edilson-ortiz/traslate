<div>
    <div class="flex justify-between items-start">
        <!-- Campo de búsqueda -->
        <div class="mt-6 mb-4">
            <input type="text" wire:model.live="search" placeholder="Buscar..."
                class="px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <!-- Botón de subir -->
        <div class="mt-6 mb-4">
            <a class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ url('upload') }}">
                Subir
            </a>
        </div>
    </div>

    <div class="mt-6">
        <div class="mt-2">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tiempo
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estado
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($documents as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->tiempo }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if (!$item->state)
                                    <span class="bg-blue-100 text-blue-500 px-2 py-1 rounded">Espera...</span>
                                @else
                                    <span class="bg-green-100 text-green-500 px-2 py-1 rounded">Procesado</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if ($item->state)
                                    <a class="text-indigo-500 hover:text-indigo-500 bg-indigo-100 hover:bg-indigo-300 p-1 rounded"
                                        href="{{ route('pdf.show', $item->id) }}" target="_blank"> pdf</a>
                                @endif

                                <button wire:click='confirModal({{ $item->id }})'
                                    class="text-red-500 hover:text-red-500 bg-red-100 hover:bg-red-300 p-1 rounded">Eliminar</button>

                                @if (!$item->state)
                                    <button wire:click='procesar({{ $item->id }})'
                                        class="text-blue-500 hover:text-blue-500 bg-blue-100 hover:bg-blue-300 p-1 rounded">
                                        <span wire:loading.remove
                                            wire:target='procesar({{ $item->id }})'>Convertir</span>
                                        <span wire:loading wire:target='procesar({{ $item->id }})'>Loading...</span>
                                    </button>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    <!-- Añade más filas según sea necesario -->
                </tbody>
            </table>
        </div>
        <!-- Enlaces de paginación -->
        <div class="mt-4">
            {{ $documents->links() }}
        </div>
    </div>

    <x-confirmation-modal wire:model="confirmingUserDeletion">
        <x-slot name="title">
            Desea eliminar el Documento
        </x-slot>

        <x-slot name="content">
            ¿Estás seguro de que quieres eliminar tu Documento? Una vez que se elimine su documento, todos sus recursos
            y
            datos se eliminarán permanentemente.
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="deleteDocumento" wire:loading.attr="disabled">
                Eliminar
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>



</div>
