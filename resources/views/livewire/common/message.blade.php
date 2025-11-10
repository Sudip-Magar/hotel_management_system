<div class="">
    <template x-if="serverErrors">
        <span class="text-red-700 bg-red-300 fixed bottom-5 right-5 px-5 py-1 rounded-lg z-100" x-text="serverErrors"></span>

    </template>

    <template x-if="success">
        <span class="text-green-700 bg-green-300 fixed bottom-5 right-5 px-5 py-1 rounded-lg z-100" x-text="success"></span>
    </template>

    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
            class="text-green-700 bg-green-300 fixed bottom-5 right-5 px-5 py-1 rounded-lg z-100">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
            class="text-red-700 bg-red-300 fixed bottom-5 right-5 px-5 py-1 rounded-lg z-100">
            {{ session('error') }}
        </div>
    @endif
</div>