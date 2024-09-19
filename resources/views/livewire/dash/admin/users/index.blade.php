<section x-data="userSearch({{ $users->toJson() }})">
    <x-slot name="button">
        <div class="flex flex-row justify-center items-center space-x-2 w-full">
            <div class="w-full" id="userHeader"></div>
            <x-button info label="Add User" icon="plus" outline hover="info"
                      class="leading-loose font-bold uppercase w-1/3 text-gray-700 dark:text-gray-200" />
        </div>
    </x-slot>

    <!-- Teleport the search input to the #userHeader div -->
    <template x-teleport="#userHeader">
        <x-input placeholder="Search User" info x-model="search" @keyup="filterUsers">
            <x-slot name="append">
                <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                    <x-button
                        @click="filterUsers"
                        class="h-full rounded-r-md"
                        icon="magnifying-glass"
                        info flat squared />
                </div>
            </x-slot>
        </x-input>
    </template>

    <!-- Display user cards in a grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-10 my-4">
        <template x-if="filteredUsers.length === 0">
            <!-- No users found card -->
            <div class="col-span-full flex justify-center items-center">
                <div class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 p-4 rounded-md shadow-md">
                    <h3 class="text-lg font-bold">No users found</h3>
                    <p>Try adjusting your search or adding new users.</p>
                </div>
            </div>
        </template>

        <template x-for="user in filteredUsers" :key="user.id">
            <div>
                <!-- User Card -->
                <div class="rounded overflow-hidden shadow-lg flex flex-col">
                    <!-- User Image -->
                    <div class="relative">
                        <img class="w-full object-cover"
                             :src="user.profile_photo_path ? `{{ asset('${user.profile_photo_path}') }}` : user.profile_photo_url"
                             :alt="user.name">
                        <!-- User Settings Button -->
                        <div class="text-xs absolute top-0 right-0 px-4 py-2 text-white mt-3 mr-3">
                            <x-mini-button rounded info icon="cog"
                                           @click="updateUser(user.id)"
                                           wire:loading.class="h-5 w-5 animate-spin" />
                        </div>
                    </div>

                    <!-- User Details -->
                    <div class="px-6 py-4 mb-auto bg-white dark:bg-slate-800">
                        <h3 class="font-medium text-lg inline-block text-gray-800 dark:text-gray-100 mb-2">
                            <span x-text="user.name"></span>
                        </h3>

                        <ul class="text-gray-500 text-sm">
                            <li>Email: <span x-text="user.email"></span></li>
                            <li>Joined: <span x-text="formatDateTime(user.created_at)"></span></li>
                            <li>
                                <!-- User Roles -->
                                <template x-for="role in user.roles">
                                    <x-filament::badge>
                                        <span x-text="role.name"></span>
                                    </x-filament::badge>
                                </template>
                            </li>
                        </ul>
                    </div>

                    <!-- User Update Timestamp -->
                    <div class="px-6 py-3 flex flex-row items-center justify-between bg-gray-100 dark:bg-slate-700">
                        <span class="py-1 text-md font-mono text-gray-500 dark:text-gray-900 space-x-2 flex flex-row items-center justify-center">
                            <x-heroicon-o-clock class="h-5 w-5" />
                            <span x-text="formatDateTime(user.updated_at)"></span>
                        </span>
                    </div>
                </div>
            </div>
        </template>
    </div>
</section>

@push('scripts')
    <script>
        function userSearch(users) {
            return {
                search: '',
                users: users,
                filteredUsers: users,
                filterUsers() {
                    const searchTerm = this.search.toLowerCase().trim();

                    this.filteredUsers = this.users.filter(user => {
                        const nameMatch = user.name.toLowerCase().includes(searchTerm);
                        const emailMatch = user.email.toLowerCase().includes(searchTerm);
                        const roleMatch = user.roles.some(role => role.name.toLowerCase().includes(searchTerm));

                        return nameMatch || emailMatch || roleMatch;
                    });
                },
                updateUser(id) {
                    alert(`Update user with id: ${id}`);
                },
                formatDateTime(dateTimeString) {
                    const options = {
                        year: 'numeric', month: 'short', day: 'numeric',
                        hour: 'numeric', minute: 'numeric', second: 'numeric',
                        hour12: true // 12-hour format
                    };
                    return new Date(dateTimeString).toLocaleString('en-US', options);
                }
            };
        }
    </script>
@endpush
