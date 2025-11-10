<div>
    <template x-if="serverErrors">
        <span class="text-red-700 bg-red-300 fixed top-5 right-5 px-5 py-1 rounded-lg" x-text="serverErrors"></span>

    </template>

    <template x-if="success">
        <span class="text-green-700 bg-green-300 fixed top-5 right-5 px-5 py-1 rounded-lg" x-text="success"></span>
    </template>

    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
            class="text-green-700 bg-green-300 fixed top-5 right-5 px-5 py-1 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
            class="text-red-700 bg-red-300 fixed top-5 right-5 px-5 py-1 rounded-lg">
            {{ session('error') }}
        </div>
    @endif
</div>