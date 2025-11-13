<div class="max-w-3xl mx-auto mt-20 p-6 bg-white rounded-lg shadow-md" x-data="service">
    @include('livewire.common.message')
    <div>
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Add Service</h2>

        <form @submit.prevent="registerGuest">
            <!-- Category Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Type Name</label>
                <input type="text" id="name" x-model="data.name"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    placeholder="Eg: WIFI, AC, TV .....">
                <template x-if="errors.name">
                    <small class="text-red-500" x-text="errors.name"></small>
                </template>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit"
                    class="cursor-pointer w-full bg-green-400 hover:bg-green-500 text-white font-semibold py-2 px-4 rounded-lg">
                    Save Category
                </button>
            </div>
        </form>
    </div>

    {{-- Guest Type List --}}
    <div class="my-5">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b text-left text-gray-600">ID</th>
                    <th class="px-4 py-2 border-b text-left text-gray-600">Image</th>
                    <th class="px-4 py-2 border-b text-center text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                <template x-if="guestTypes && guestTypes.length > 0">
                    <template x-for="(type,index) in guestTypes" :key="index">
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border-b" x-text="index + 1"></td>

                            <td class="px-4 py-2 border-b" x-text="type.name"></td>

                            <td class="px-4 py-2 border-b text-center space-x-2">
                                <button @click.prevent="updateModalView(type.id)"
                                    class="cursor-pointer bg-blue-300 text-blue-700 hover:bg-blue-400 px-3 py-1 rounded"><i
                                        class="fa-solid fa-pen"></i></button>
                                <button
                                    class="cursor-pointer bg-red-300 text-red-700 hover:bg-red-400 px-3 py-1 rounded"
                                    @click.prevent="deleteModal(type.id)"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    </template>
                </template>

                <template x-if="!guestTypes || guestTypes.length === 0">
                    <tr class="text-center ">
                        <td class="py-20 text-2xl font-semibold text-gray-400" colspan="3">Currently there no Service.
                            Try creating one </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    {{-- Guest Type Updation --}}
    <div x-show="updateModal" x-transition.opacity x-cloak
        class="fixed inset-0 flex items-center justify-center bg-gray-900/80 z-75">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <span class="absolute top-5 right-5 cursor-pointer" @click.prevent="closeModel"><i
                    class="fa-solid fa-xmark"></i></span>
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Add Guest Type</h2>

            <form @submit.prevent="updateGuest">
                <!-- guest type Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Type Name</label>
                    <input type="text" id="name" x-model="temData.name"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        placeholder="Eg: Family, Friends .....">
                    <template x-if="errors.tempName">
                        <small class="text-red-500" x-text="errors.tempName"></small>
                    </template>
                </div>

            <div class="flex justify-end space-x-3">
               

                <button class="cursor-pointer px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Update
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showModal" x-transition.opacity x-cloak
        class="fixed inset-0 flex items-center justify-center bg-gray-900/80 z-75">
        <div @click.outside = 'closeModel' class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <span class="absolute top-5 right-5 cursor-pointer" @click.prevent="closeModel"><i
                    class="fa-solid fa-xmark"></i></span>
            <h2 class="text-xl font-semibold mb-4 text-red-500">
                Delete Category
            </h2>

            <p class="text-gray-700 mb-6">
                Are you sure you want to delete the Service "<span class="font-semibold"
                    x-text="temData.name"></span>"?
                This action cannot be undone.
            </p>

            <div class="flex justify-end space-x-3">
                <button class="cursor-pointer px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300"
                    @click.prevent="closeModel">
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
