<div class="max-w-6xl mx-auto p-6 bg-gray-50 min-h-screen" x-data="room">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Available Rooms</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Room Card -->
        <template x-for="(room, index) in rooms">
            <a :href="'/room/room-detail/' + room.id" title="View Detail">
                <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <img :src="'/storage/' + room.room_images[0].image" alt="Room Image" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-gray-800" x-text="room.room_number"></h2>
                        <p class="text-gray-600 mt-2 border-b" x-text="room.category.name"></p>
                        <p class="text-gray-600 mt-2">Spacious suite with luxury amenities and a beautiful city view.</p>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-green-600 font-semibold text-lg" >Rs. <span x-text=" room.price"></span>/night</span>
                            <button
                                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-200">
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>
            </a>
        </template>
    </div>
</div>
