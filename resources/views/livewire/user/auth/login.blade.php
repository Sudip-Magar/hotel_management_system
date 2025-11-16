<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4" x-data="userLogin">
    @include('livewire.common.message')

    <div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-md">

        <h2 class="text-2xl font-bold text-gray-800 mb-2 text-center">
            Login Form
        </h2>
        <p class="text-sm text-gray-500 mb-6 text-center">
            Login to your account
        </p>

        <form @submit.prevent="register" action="" class="space-y-5">

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

           <!-- Submit Button -->
            <button type="submit"
                class="cursor-pointer w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition duration-150">
                Create Account
            </button>

            <!-- Login Redirect -->
            <p class="text-center text-sm text-gray-600 mt-3">
                Don't have an account?
                <a href="{{ route('user.register') }}" class="text-blue-600 font-medium hover:underline">
                    Register
                </a>
            </p>
        </form>
    </div>
</div>
