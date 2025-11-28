<div wire:ignore class="max-w-[85%] mx-auto p-6" x-data="room">

    @include('livewire.common.message')
    <h1 class="text-3xl font-bold mb-8 text-center">Available Rooms</h1>

    <!-- Loading Overlay -->
    <div x-show="!loaded" x-transition.opacity x-cloak
        class="fixed inset-0 flex items-center justify-center bg-gray-900/80 z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-sm p-6 text-center">
            <span class="text-lg font-medium">Loading rooms...</span>
        </div>
    </div>

    <!-- Main Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

        <!-- Filters -->
        <div class="bg-white shadow-md rounded-2xl p-5 h-fit ">
            <!-- Search Bar -->
            <div class=" my-5">
                <label for="room"> Search Room:</label>
                <input type="text" class="border py-1 px-2 rounded-lg  outline-gray-800 w-full shadow-sm" x-model="search"
                    placeholder="Search Room.....">
            </div>
            <h2 class="text-xl font-semibold mb-4">Filter by Category</h2>

            <div class="space-y-2">
                <template x-for="dbCategory in dbCategories" :key="dbCategory.id">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" :checked="category === dbCategory.name"
                            @change.prevent="category = $event.target.checked ? dbCategory.name : ''"
                            class="h-4 w-4 rounded border-gray-300 cursor-pointer" :value="dbCategory.name"
                            :id="'cat-' + dbCategory.id">

                        <span x-text="dbCategory.name" class="text-gray-700"></span>
                    </label>
                </template>
            </div>
        </div>

        <!-- Room List -->
        <div class="lg:col-span-4">

            <template x-if="loaded">
                <div>

                    <!-- Room Grid -->
                    <template x-if="rooms && rooms.length > 0">
                        <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6">

                            <template x-for="(room, idx) in rooms" :key="room.id">
                                <a :href="'/room/room-detail/' + room.id"
                                    class="block bg-white rounded-xl shadow-sm hover:shadow-2xl transition duration-300 overflow-hidden">

                                    <!-- Image -->
                                    <div class="relative w-full h-48 bg-gray-100">
                                        <img :src="'/storage/' + room.room_images[0].image"
                                            class="w-full h-full object-cover" />
                                    </div>

                                    <!-- Content -->
                                    <div class="p-5">

                                        <h2 class="text-xl font-semibold mb-1">
                                            Room: <span x-text="room.room_number"></span>
                                        </h2>

                                        <p class="text-sm text-gray-400 mb-2">Non Refundable</p>

                                        <p class="text-gray-600">
                                            Category:
                                            <span class="font-medium" x-text="room.category.name"></span>
                                        </p>

                                        <p class="text-gray-600">
                                            Guest Type:
                                            <span class="font-medium" x-text="room.guest_type.name"></span>
                                        </p>

                                        <p class="text-gray-600">
                                            Max Guests:
                                            <span class="font-medium" x-text="room.max_guest"></span>
                                        </p>

                                        <p class="text-gray-600 mb-4">
                                            Price: Rs.
                                            <span class="font-medium" x-text="room.price"></span>
                                        </p>

                                        <!-- Features -->
                                        <div class="flex flex-wrap gap-2 text-gray-700 text-sm mb-3">
                                            <span class="flex items-center gap-1">
                                                🛏 <span x-text="room.room_feature.bedroom_count"></span> Beds
                                            </span>
                                            <span class="flex items-center gap-1">
                                                🚽 <span x-text="room.room_feature.toilet_count"></span> Toilets
                                            </span>
                                            <span class="flex items-center gap-1">
                                                🍳 <span x-text="room.room_feature.has_kitchen ? 'Kitchen' : ''"></span>
                                            </span>
                                            <span class="flex items-center gap-1">
                                                🛋 <span
                                                    x-text="room.room_feature.has_living_room ? 'Living' : ''"></span>
                                            </span>
                                        </div>

                                        <!-- Services -->
                                        <div>
                                            <h3 class="font-semibold mb-1">Services</h3>
                                            <div class="grid grid-cols-2 gap-2">
                                                <template x-for="service in room.services.slice(0,4)">
                                                    <span
                                                        class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs text-center"
                                                        x-text="service.name"></span>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </template>

                        </div>
                    </template>

                    <!-- No Rooms Found -->
                    <template x-if="!rooms || rooms.length === 0">
                        <div class="flex justify-center mt-20">
                            <p class="text-gray-400 font-semibold text-2xl">No Room Found</p>
                        </div>
                    </template>

                </div>
            </template>

        </div>
    </div>
</div>
