<div wire:ignore class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md" x-data="roomCategoryList">
    @include('livewire.common.message')

    <div class="my-4 text-end">
        <p class="text-green-800 bg-green-300 px-3 py-1 rounded-lg transition hover:scale-105 inline-block"
            href="">
            <a href="{{ route('admin.room-category.create') }}">Create New Category</a>
        </p>
    </div>
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Room Categories</h2>

    <table class="min-w-full border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border-b text-left text-gray-600">ID</th>
                <th class="px-4 py-2 border-b text-left text-gray-600">Category Name</th>
                <th class="px-4 py-2 border-b text-left text-gray-600 w-2/4">Description</th>
                <th class="px-4 py-2 border-b text-gray-600 text-end">Price/Night</th>
                <th class="px-4 py-2 border-b text-center text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody>
            <template x-for="(category,idx) in roomCategories">
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border-b" x-text="idx + 1"></td>
                    <td class="px-4 py-2 border-b" x-text="category.name"></td>
                    <td class="px-4 py-2 border-b"
                        x-text="category.description.split(' ').slice(0, 7).join(' ') + (category.description.split(' ').length > 7 ? '...' : '')">
                    </td>
                    <td class="px-4 py-2 border-b text-end" x-text="category.base_price"></td>
                    <td class="px-4 py-2 border-b text-center space-x-2">
                        <a :href="'/admin/room-category/view/' + category.id"
                            class="cursor-pointer bg-blue-300 text-blue-700 hover:bg-blue-400 px-3 py-1 rounded"><i class="fa-solid fa-eye"></i></a>
                        <button class="cursor-pointer bg-red-300 text-red-700 hover:bg-red-400 px-3 py-1 rounded"
                            @click.prevent="deleteModal(category.id)"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>

    <!-- Delete Confirmation Modal -->
    <div x-show="showModal" x-transition.opacity x-cloak
        class="fixed inset-0 flex items-center justify-center bg-gray-900/80 z-75">
        <div @click.outside = 'showModal = false' class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <span class="absolute top-5 right-5 cursor-pointer" @click.prevent="showModal = false"><i class="fa-solid fa-xmark"></i></span>
            <h2 class="text-xl font-semibold mb-4 text-red-500">
                Delete Category
            </h2>

            <p class="text-gray-700 mb-6">
                Are you sure you want to delete the category "<span class="font-semibold" x-text="data.name"></span>"?
                This action cannot be undone.
            </p>

            <div class="flex justify-end space-x-3">
                <button class="cursor-pointer px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300"
                    @click.prevent="showModal = false">
                    Cancel
                </button>

                <button class="cursor-pointer px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
                    @click.prevent="confirmDelete()">
                    Delete
                </button>
            </div>
        </div>
    </div>

</div>
