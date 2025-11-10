<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4" x-data="register">
    @include('livewire.common.message')

    <div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-md">

        <h2 class="text-2xl font-bold text-gray-800 mb-2 text-center">
            Admin Registration
        </h2>
        <p class="text-sm text-gray-500 mb-6 text-center">
            Create your administrator account
        </p>

        <form @submit.prevent="register" action="" class="space-y-5">

            <div class="text-center">
                @if (!$image)
                    <img class="inline-block w-30 h-30 object-cover rounded-full"
                        src="{{ asset('storage/default/user.jpeg') }}" alt="">
                @else
                    <img class="inline-block w-30 h-30 object-cover rounded-full" src="{{ $image->temporaryUrl() }}"
                        alt="">
                @endif
            </div>

            <div class="text-center">
                <label for="image" class="bg-green-300 text-green-700 px-3 py-1.5 rounded-lg cursor-pointer">Upload
                    Image</label>
                <input type="file" wire:model="image" id="image" class="hidden" />
            </div>

            <!-- Name -->
            <div>
                <label class="block mb-1 text-gray-700 font-medium">Full Name <span
                        class="text-red-500">*</span></label>
                <input type="text" x-model="data.name"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 focus:outline-none"
                    placeholder="Enter your full name" required>
                <template x-if="errors.name">
                    <small class="text-red-500" x-text="errors.name"></small>
                </template>
            </div>

            <div>
                <label class="block mb-1 text-gray-700 font-medium">Phone Number</label>
                <input type="number" x-model="data.phone"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 focus:outline-none"
                    placeholder="Enter your fphone number" required>
                <template x-if="errors.phone">
                    <small class="text-red-500" x-text="errors.phone"></small>
                </template>
            </div>

            <!-- Email -->
            <div>
                <label class="block mb-1 text-gray-700 font-medium">Email Address <span
                        class="text-red-500">*</span></label>
                <input type="email" x-model="data.email"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 focus:outline-none"
                    placeholder="admin@example.com" required>
                <template x-if="errors.email">
                    <small class="text-red-500" x-text="errors.email"></small>
                </template>
            </div>

            <!-- Password -->
            <div>
                <label class="block mb-1 text-gray-700 font-medium">Password <span class="text-red-500">*</span></label>
                <input type="password" x-model="data.password"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 focus:outline-none"
                    placeholder="Enter a strong password" required>
                <template x-if="errors.password">
                    <small class="text-red-500" x-text="errors.password"></small>
                </template>
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block mb-1 text-gray-700 font-medium">Confirm Password <span
                        class="text-red-500">*</span></label>
                <input type="password" x-model="data.password_confirmation"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 focus:outline-none"
                    placeholder="Confirm password" required>
                <template x-if="errors.password_confirmation">
                    <small class="text-red-500" x-text="errors.password_confirmation"></small>
                </template>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="cursor-pointer w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition duration-150">
                Create Account
            </button>

            <!-- Login Redirect -->
            <p class="text-center text-sm text-gray-600 mt-3">
                Already have an account?
                <a href="{{ route('admin.login') }}" class="text-blue-600 font-medium hover:underline">
                    Login here
                </a>
            </p>
        </form>
    </div>
</div>
