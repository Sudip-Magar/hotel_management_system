<div class="max-w-3xl mx-auto mt-20 p-6 bg-white rounded-lg shadow-md" x-data="createRoom">
    @include('livewire.common.message')
    <div class="my-4 text-end">
        <p class="text-green-800 bg-green-300 px-3 py-1 rounded-lg transition hover:scale-105 inline-block"
            href="">
            <a href="{{ route('admin.room.list') }}"> Room List</a>
        </p>
    </div>
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Add Room</h2>

    <form @submit.prevent="registerRoom">
        <div class="text-end">
            <button @click.prevent="serviceShowButton" class="bg-blue-300 text-blue-800 py-1 px-2 rounded-lg cursor-pointer hover:bg-blue-400" x-text="serviceShow ? 'Room':'Service'"></button>
        </div>

        <div x-show="roomShow">
            <!-- Category Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Room No:</label>
                <input type="text" id="name" x-model="data.room_number"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    placeholder="Enter category name">
                <template x-if="errors.room_number">
                    <small class="text-red-500" x-text="errors.room_number"></small>
                </template>
            </div>

            <div class="mb-4">
                <label for="category">Room Category:</label>
                <select class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    x-model="data.category_id">
                    <option>-- Select Room Category --</option>
                    <template x-for="(category,idx) in categories">
                        <option :value="category.id" :key="category.id" x-text="category.name"> <span></span>
                        </option>
                    </template>
                </select>
                <template x-if="errors.category_id">
                    <small class="text-red-500" x-text="errors.category_id"></small>
                </template>
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-medium mb-2">Price per Night</label>
                <input type="number" id="price" min="0" x-model="data.price"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    placeholder="Enter price">
                <template x-if="errors.price">
                    <small class="text-red-500" x-text="errors.price"></small>
                </template>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Max Guest:</label>
                <input type="number" id="name" x-model="data.max_guest"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    placeholder="Enter category name">
                <template x-if="errors.max_guest">
                    <small class="text-red-500" x-text="errors.max_guest"></small>
                </template>
            </div>

            {{-- Room Image --}}
            <div class="text-end pt-3">
                <label for="image"
                    class="text-green-800 bg-green-300 px-3 py-1 rounded-lg cursor-pointer hover:bg-green-400">Upload
                    Room
                    Image</label>
                <input type="file" wire:model='images' class="hidden" id="image" multiple>
            </div>
        </div>

        <div x-show="serviceShow" class="">
            <h2 class="text-lg font-semibold mb-4">Select Services</h2>
            <div class="grid grid-cols-3 space-y-2">
                <label class="inline-flex items-center">
                    <input type="checkbox" x-model="services" value="Breakfast"
                        class="form-checkbox h-5 w-5 text-green-500">
                    <span class="ml-2 text-gray-700">Breakfast</span>
                </label>

                <label class="inline-flex items-center">
                    <input type="checkbox" x-model="services" value="Airport Pickup"
                        class="form-checkbox h-5 w-5 text-green-500">
                    <span class="ml-2 text-gray-700">Airport Pickup</span>
                </label>

                <label class="inline-flex items-center">
                    <input type="checkbox" x-model="services" value="Spa Access"
                        class="form-checkbox h-5 w-5 text-green-500">
                    <span class="ml-2 text-gray-700">Spa Access</span>
                </label>

                <label class="inline-flex items-center">
                    <input type="checkbox" x-model="services" value="Gym Access"
                        class="form-checkbox h-5 w-5 text-green-500">
                    <span class="ml-2 text-gray-700">Gym Access</span>
                </label>

                <label class="inline-flex items-center">
                    <input type="checkbox" x-model="services" value="Laundry"
                        class="form-checkbox h-5 w-5 text-green-500">
                    <span class="ml-2 text-gray-700">Laundry</span>
                </label>

                <label class="inline-flex items-center">
                    <input type="checkbox" x-model="services" value="Wi-Fi"
                        class="form-checkbox h-5 w-5 text-green-500">
                    <span class="ml-2 text-gray-700">Wi-Fi</span>
                </label>

                <label class="inline-flex items-center">
                    <input type="checkbox" x-model="services" value="Room Service"
                        class="form-checkbox h-5 w-5 text-green-500">
                    <span class="ml-2 text-gray-700">Room Service</span>
                </label>

                <label class="inline-flex items-center">
                    <input type="checkbox" x-model="services" value="Mini Bar"
                        class="form-checkbox h-5 w-5 text-green-500">
                    <span class="ml-2 text-gray-700">Mini Bar</span>
                </label>

                <label class="inline-flex items-center">
                    <input type="checkbox" x-model="services" value="Laundry Pickup"
                        class="form-checkbox h-5 w-5 text-green-500">
                    <span class="ml-2 text-gray-700">Laundry Pickup</span>
                </label>

                <label class="inline-flex items-center">
                    <input type="checkbox" x-model="services" value="Concierge"
                        class="form-checkbox h-5 w-5 text-green-500">
                    <span class="ml-2 text-gray-700">Concierge</span>
                </label>

                <label class="inline-flex items-center">
                    <input type="checkbox" x-model="services" value="Valet Parking"
                        class="form-checkbox h-5 w-5 text-green-500">
                    <span class="ml-2 text-gray-700">Valet Parking</span>
                </label>
            </div>
        </div>


        @if ($images)
            <div class="mt-3 flex flex-wrap gap-3">
                @foreach ($images as $index => $image)
                    <div class="relative">
                        <img src="{{ $image->temporaryUrl() }}" class="h-24 w-24 object-cover rounded-lg">
                        <button type="button" wire:click="removeImage({{ $index }})"
                            class="cursor-pointer absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-600">
                            &times;
                        </button>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Submit Button -->
        <div class="mt-6">
            <button @click.pevent="hello"
                class="cursor-pointer w-full bg-green-400 hover:bg-green-500 text-white font-semibold py-2 px-4 rounded-lg">
                Save Room
            </button>
        </div>
    </form>
</div>
