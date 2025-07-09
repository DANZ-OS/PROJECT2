<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Header dengan Actions --}}
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ $this->getTitle() }}
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Kelola informasi profil Anda
                </p>
            </div>
        </div>

        {{-- Card untuk menampilkan data profil --}}
        @if (!$this->isEditing)
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    Informasi Profil
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Nama Lengkap
                        </label>
                        <p class="text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 rounded-md px-3 py-2">
                            {{ $this->getUserData()['name'] ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Email
                        </label>
                        <p class="text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 rounded-md px-3 py-2">
                            {{ $this->getUserData()['email'] ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            NIM
                        </label>
                        <p class="text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 rounded-md px-3 py-2">
                            {{ $this->getUserData()['nim'] ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Jurusan
                        </label>
                        <p class="text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 rounded-md px-3 py-2">
                            {{ $this->getUserData()['jurusan'] ?? '-' }}
                        </p>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Asal Kampus
                        </label>
                        <p class="text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 rounded-md px-3 py-2">
                            {{ $this->getUserData()['asal_kampus'] ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Form untuk edit profil --}}
        @if ($this->isEditing)
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    Edit Profil
                </h3>
                
                <form wire:submit="updateProfil">
                    {{ $this->form }}
                </form>
            </div>
        @endif
    </div>
</x-filament-panels::page>