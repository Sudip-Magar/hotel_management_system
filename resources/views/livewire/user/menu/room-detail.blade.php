<div class="max-w-5xl mx-auto mt-16 bg-white rounded-lg shadow-md overflow-hidden" x-data="roomDatail">
    @include('livewire.common.message')
    <!-- loading -->
    <div x-show="!loaded" x-transition.opacity x-cloak
        class="fixed inset-0 flex items-center justify-center bg-gray-900/80 z-75">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            Loading rooms...
        </div>
    </div>

    <template x-if="loaded">
        <div class=" py-10">

            <div class="max-w-5xl mx-auto bg-white shadow rounded-lg overflow-hidden">

                <!-- Images Section -->
                <div class="p-4">

                    <!-- Main Image -->
                    <div class="mb-4">
                        <img :src="'/storage/' + room.room_images[activeImage].image"
                            class="w-full h-72 object-cover rounded-lg" />
                    </div>

                    {{-- Image Thumbnails --}}
                    <div class="flex gap-2">
                        <template x-for="(image,idx) in room.room_images">
                            <img :src="'/storage/' + image.image"
                                class="h-20 w-28 object-cover rounded cursor-pointer border-2"
                                :class="activeImage === idx ? 'border-green-600' : 'border-transparent'"
                                @click.prevent="activeImage = idx" />
                        </template>
                    </div>

                </div>

                <!-- Room Information -->
                <div class="p-6">

                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800" x-text="room.room_number"></h1>
                            <p class="text-gray-600">Category: <strong x-text="room.category.name"></strong></p>
                            <p class="text-gray-600">Guest Type: <strong x-text="room.guest_type.name"></strong></p>
                        </div>

                        <div class="text-right">
                            <p class="text-3xl font-bold text-green-700">Rs. <span
                                    x-text="new Intl.NumberFormat().format(room.price)"></span></p>
                            <p class="text-gray-500 text-sm">Per stay</p>
                        </div>
                    </div>

                    <hr class="my-5">

                    <!-- Features -->
                    <h2 class="text-xl font-semibold mb-3 text-gray-700">Room Features</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-gray-700">
                        <p><strong>Bedrooms:</strong> <span x-text="room.room_feature.bedroom_count"></span> </p>
                        <p><strong>Toilets:</strong> <span x-text="room.room_feature.toilet_count"></span></p>
                        <p><strong>Kitchen:</strong> <span x-text="room.room_feature.has_kitchen ? 'Yes': 'No'"></span>
                        </p>
                        <p><strong>Balcony:</strong> <span x-text="room.room_feature.has_balcony ? 'Yes': 'No'"></span>
                        </p>
                        <p><strong>Living:</strong> <span
                                x-text="room.room_feature.has_living_room ? 'Yes': 'No'"></span></p>
                        <p><strong>Max Guests:</strong> <span x-text="room.max_guest"></span> </p>
                    </div>

                    <hr class="my-6">

                    <!-- Services -->
                    <h2 class="text-xl font-semibold mb-3 text-gray-700">Services</h2>

                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-2 text-gray-700">

                        <template x-for="service in room.services">
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                <span x-text="service.name"></span>
                            </li>
                        </template>

                    </ul>

                    <hr class="my-6">

                    <!-- Status + Action -->
                    <div class="flex justify-between items-center mx-4">
                        <div>
                            <strong>Reserved on:</strong>
                            <template x-if="room.reservations && room.reservations.length > 0">
                                <ul class="">
                                    <template x-for="reserve in room.reservations || []" :key="reserve.id">
                                        <div class="text-gray-700">
                                            <li class="flex items-center gap-3">
                                                <span class="w-2 h-2 bg-red-500 rounded-sm inline-block"></span>
                                                <span class="inline-block"
                                                    x-text="new Date(reserve.check_in).toLocaleDateString('en-US', { day: 'numeric', month: 'short', year: 'numeric' })  + ' - ' +  new Date(reserve.check_out).toLocaleDateString('en-US', { day: 'numeric', month: 'short', year: 'numeric' })">
                                                </span>
                                            </li>
                                        </div>
                                    </template>
                                </ul>
                            </template>

                            <template x-if="room.reservations && room.reservations.length === 0">
                                <div class="text-green-500">No Reservation </div>
                            </template>
                        </div>
                        <button @click.prevent="showBookModal"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow cursor-pointer">
                            Book Now
                        </button>
                    </div>

                </div>

            </div>

        </div>
    </template>

    <div x-show="showModal" x-transition.opacity x-cloak
        class="fixed inset-0 flex items-center justify-center bg-gray-900/80 z-75">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <span class="absolute top-5 right-5 cursor-pointer" @click.prevent="closeModel"><i
                    class="fa-solid fa-xmark"></i></span>

            <form @submit.prevent="reserve">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Enter Guest Name</label>
                    <input type="text" id="name" x-model="data.guest_name"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        placeholder="Eg: Your Name">
                    <template x-if="errors.guest_name">
                        <small class="text-red-500" x-text="errors.guest_name"></small>
                    </template>
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 font-medium mb-2">Enter Guest Number</label>
                    <input type="text" id="phone" x-model="data.guest_phone"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        placeholder="Eg: Your Mobile Number">
                    <template x-if="errors.guest_phone">
                        <small class="text-red-500" x-text="errors.guest_phone"></small>
                    </template>
                </div>

                <div class=" mx-auto bg-white p-6 rounded-xl shadow-md my-10">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Reservation Date</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Check-in -->
                        <div class="flex flex-col">
                            <label class="text-gray-700 font-medium mb-1">Select Check-in</label>
                            <input type="date" x-model="data.check_in"
                                class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <template x-if="errors.check_in">
                                <small class="text-red-500" x-text="errors.check_in"></small>
                            </template>
                        </div>

                        <!-- Check-out -->
                        <div class="flex flex-col">
                            <label class="text-gray-700 font-medium mb-1">Select Check-out</label>
                            <input type="date" x-model="data.check_out"
                                class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <template x-if="errors.check_out">
                                <small class="text-red-500" x-text="errors.check_out"></small>
                            </template>
                        </div>
                    </div>

                    <div class="my-4">
                        <span class="block text-gray-700 font-medium mb-2">Total Days: <span
                                x-text="days"></span></span>
                    </div>

                    <div class="my-4">
                        <span class="block text-gray-700 font-medium mb-2">Total Price: <span
                                x-text="price"></span></span>
                    </div>
                    <div>
                        <strong>Reserved on:</strong>
                        <template x-if="room.reservations && room.reservations.length > 0">
                            <ul class="">
                                <template x-for="reserve in room.reservations || []" :key="reserve.id">
                                    <div class="text-gray-700">
                                        <li class="flex items-center gap-3">
                                            <span class="w-2 h-2 bg-red-500 rounded-sm inline-block"></span>
                                            <span class="inline-block"
                                                x-text="new Date(reserve.check_in).toLocaleDateString('en-US', { day: 'numeric', month: 'short', year: 'numeric' })  + ' - ' +  new Date(reserve.check_out).toLocaleDateString('en-US', { day: 'numeric', month: 'short', year: 'numeric' })">
                                            </span>
                                        </li>
                                    </div>
                                </template>
                            </ul>
                        </template>

                        <template x-if="room.reservations && room.reservations.length === 0">
                            <div class="text-green-500">No Reservation </div>
                        </template>
                    </div>

                    <template x-if="dateError">
                        <div class="my-4">
                            <span class="text-red-500" x-text="dateError"></span>
                        </div>
                    </template>
                </div>

                <div class="flex justify-end space-x-3">


                    <button class="cursor-pointer px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Book now
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
