<nav class="bg-gray-800 text-white shadow-md sticky top-0 z-50">
  <div class="max-w-[80%] mx-auto px-4">
    <div class="flex justify-between h-16">
      
      <!-- Logo -->
      <div class="flex items-center">
        <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-green-400">HimalayaHotel</a>
      </div>


      <!-- User Profile -->
      <div class="lg:flex items-center space-x-4 hidden">
        {{-- <span class="hidden md:block">{{ Auth::guard('admin')->user()->name }}</span> --}}
        <form action="{{ route('admin.logout') }}" method="POST" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded">
          @csrf
          <button class="cursor-pointer" type="submit">Logout</button>
        </form>
      </div>
      

      <!-- Mobile Menu Button -->
      <div class="md:hidden flex items-center">
        <button id="mobile-menu-btn" class="focus:outline-none">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
               viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden md:hidden px-4 pt-2 pb-4 space-y-1 bg-gray-700">
    <a href="#" class="block hover:text-yellow-400">Dashboard</a>
    <a href="#" class="block hover:text-yellow-400">Rooms</a>
    <a href="#" class="block hover:text-yellow-400">Bookings</a>
    <a href="#" class="block hover:text-yellow-400">Users</a>
    <a href="" class="block hover:text-yellow-400">Reports</a>
    <a href="" class="block hover:text-yellow-400">Settings</a>
    <a href="" class="block bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-center">Logout</a>
  </div>

  <script>
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    btn.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });
  </script>
</nav>
