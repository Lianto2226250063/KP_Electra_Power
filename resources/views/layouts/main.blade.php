<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <script src="{{ asset('js/jquery.min.js')}}"></script>

    <script src="{{ asset('js/datatables.js') }}"></script>
    <script src="{{ asset('js/select2.js') }}"></script>
    <style>
      .gradient-custom-2 {
        /* fallback for old browsers */
        background: #121766;
        
        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, #121766, #2f31a0, #132796, #1f22c7);
        
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, #121766, #2f31a0, #132796, #1f22c7);
      }
    </style>
  </head>
  <body class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md" x-data="{ openInvoice: false, openItem: false }">
      <div class="p-6 border-b">
        <h1 class="text-xl font-bold text-gray-800"><img src={{asset("images/ElectraPower.png")}} width="200px" height="150px"></h1>
      </div>
      <nav class="p-4 space-y-2">
        <a href="/dashboard" class="block px-4 py-2 rounded hover:bg-gray-200">Dashboard</a>
        <!-- Invoice -->
        <a href="/invoice/index" class="block px-4 py-2 rounded hover:bg-gray-200">Invoice</a>
        
        <a href="/barang/index" class="block px-4 py-2 rounded hover:bg-gray-200">Barang & Jasa</a>    
        
        <a href="/user/index" class="block px-4 py-2 rounded hover:bg-gray-200">Pegawai</a>
        
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="block w-full px-4 py-2 text-left rounded hover:bg-gray-200">
            Logout
          </button>
        </form>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 gradient-custom-2">
      <header class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-light">Hello {{Auth::user()->name}}!</h2>
      </header>

      <div id="main" class="bg-white rounded-lg shadow p-6 mb-6">
        <div id="content">
            @yield('content')
        </div>
            @stack('scripts')
      </div>
    </main>
  </body>
</html>
