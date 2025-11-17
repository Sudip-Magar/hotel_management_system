<div wire:ignore class="max-w-7xl mx-auto p-6" x-data="room">
    @include('livewire.common.message')
    <h1 class="text-3xl font-bold mb-6 text-center">Available Rooms</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- loading -->
        <div x-show="!loaded" x-transition.opacity x-cloak
            class="fixed inset-0 flex items-center justify-center bg-gray-900/80 z-75">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
                Loading rooms...
            </div>
        </div>
        <!-- Room Card Start -->
        <template x-if="loaded">
            <template x-for="(room, idx) in rooms">
                <a :href="'/room/room-detail/' + room.id" title="View Detail">
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                        <!-- Room Images Carousel -->
                        <div class="relative w-full h-48 overflow-hidden">
                            <img :src="'/storage/' + room.room_images[0].image" alt="Room Image"
                                class="w-full h-full object-cover">
                        </div>

                        <!-- Room Info -->
                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-1">Room Number: <span x-text="room.room_number"></span>
                            </h2>
                            <p class="text-gray-600 mb-1">Category: <span class="font-medium"
                                    x-text="room.category.name"></span></p>
                            <p class="text-gray-600 mb-1">Guest Type: <span class="font-medium"
                                    x-text="room.guest_type.name"></span></p>
                            <p class="text-gray-600 mb-1">Max Guests: <span class="font-medium"
                                    x-text="room.max_guest"></span>
                            </p>
                            <p class="text-gray-600 mb-1">Price: Rs. <span class="font-medium"
                                    x-text="room.price"></span>
                            </p>
                            

                            <!-- Room Features -->
                            <div class="flex flex-wrap gap-2 mb-2 text-gray-700">
                                <span class="flex items-center gap-1">
                                    🛏 <span x-text="room.room_feature.bedroom_count"></span> Bedrooms
                                </span>
                                <span class="flex items-center gap-1">
                                    🚽 <span x-text="room.room_feature.toilet_count"></span> Toilets
                                </span>
                                <span class="flex items-center gap-1">
                                    🍳 Kitchen: <span x-text="room.room_feature.has_kitchen ? 'Yes' : 'No'"></span>
                                </span>
                                <span class="flex items-center gap-1">
                                    🛋 Living Room: <span
                                        x-text="room.room_feature.has_living_room ? 'Yes' : 'No'"></span>
                                </span>
                            </div>

                            <!-- Services -->
                            <div class="mb-4">
                                <h3 class="font-semibold mb-1">Services:</h3>
                                <div class="grid grid-cols-2 text-center gap-3">
                                    <template x-for="(service,idx) in room.services.slice(0,4)">

                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm"
                                            x-text="service.name"></span>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </template>
        </template>
    </div>
</div>
