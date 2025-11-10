<div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md" x-data="roomCategoryList">
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
                <th class="px-4 py-2 border-b text-left text-gray-600">Description</th>
                <th class="px-4 py-2 border-b text-left text-gray-600">Price/Night</th>
                <th class="px-4 py-2 border-b text-left text-gray-600">Capacity</th>
                <th class="px-4 py-2 border-b text-center text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody>
            <template x-for="(category,idx) in roomCategories">
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b" x-text="idx + 1"></td>
                    <td class="px-4 py-2 border-b" x-text="category.name"></td>
                    <td class="px-4 py-2 border-b"  x-text="category.description.split(' ').slice(0, 10).join(' ') + (category.description.split(' ').length > 10 ? '...' : '')"></td>
                    <td class="px-4 py-2 border-b" x-text="category.base_price"></td>
                    <td class="px-4 py-2 border-b" x-text="category.capacity"></td>
                    <td class="px-4 py-2 border-b text-center space-x-2">
                        <a href="" class="bg-blue-300 text-blue-700 hover:bg-blue-400 px-3 py-1 rounded" >Edit</a>
                        <button class="bg-red-300 text-red-700 hover:bg-red-400 px-3 py-1 rounded">Delete</button>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">

    </div>
</div>
