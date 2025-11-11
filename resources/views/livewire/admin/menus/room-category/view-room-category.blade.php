<div class="max-w-3xl mx-auto mt-20 p-6 bg-white rounded-lg shadow-md" x-data="viewRoomCategory">
    @include('livewire.common.message')
    <div class="my-4 text-end">
        <p class="text-green-800 bg-green-300 px-3 py-1 rounded-lg transition hover:scale-105 inline-block"
            href="">
            <a href="{{ route('admin.room-category.list') }}"> Category List</a>
        </p>
    </div>
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Room Category Detail</h2>

    <form @submit.prevent="updateCategory">
        <!-- Category Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Category Name</label>
            <input type="text" id="name" x-model="data.name"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400"
                placeholder="Enter category name" required>
            <template x-if="errors.name">
                <small class="text-red-500" x-text="errors.name"></small>
            </template>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea id="description" rows="10" x-model="data.description"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400"
                placeholder="Enter category description"></textarea>
            <template x-if="errors.description">
                <small class="text-red-500" x-text="errors.description"></small>
            </template>
        </div>

        <!-- Price -->
        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-medium mb-2">Price per Night</label>
            <input type="number" id="price" min="0" x-model="data.base_price"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400"
                placeholder="Enter price" required>
            <template x-if="errors.base_price">
                <small class="text-red-500" x-text="errors.base_price"></small>
            </template>
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit"
                class="cursor-pointer w-full bg-green-400 hover:bg-green-500 text-white font-semibold py-2 px-4 rounded-lg">
                Update Category
            </button>
        </div>
    </form>
</div>
