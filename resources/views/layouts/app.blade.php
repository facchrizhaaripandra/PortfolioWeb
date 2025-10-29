<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Portfolio Teknik Informatika</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .hover-scale {
            transition: transform 0.3s ease;
        }
        .hover-scale:hover {
            transform: translateY(-5px);
        }

        /* Navigation Active State */
        .nav-active {
            color: #3b82f6;
            font-weight: 600;
        }

        /* Pagination Styles */
        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 2rem 0;
        }

        .pagination li {
            margin: 0 0.25rem;
        }

        .pagination li a,
        .pagination li span {
            display: inline-block;
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            color: #374151;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .pagination li a:hover {
            background-color: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .pagination li.active span {
            background-color: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .pagination li.disabled span {
            color: #9ca3af;
            background-color: #f3f4f6;
            border-color: #d1d5db;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800">
                        <i class="fas fa-code text-blue-600 mr-2"></i>
                        Portfolio
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}"
                       class="text-gray-600 hover:text-blue-600 transition duration-300 {{ request()->routeIs('home') ? 'nav-active' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('projects') }}"
                       class="text-gray-600 hover:text-blue-600 transition duration-300 {{ request()->routeIs('projects') ? 'nav-active' : '' }}">
                        Projects
                    </a>
                    <a href="{{ route('about') }}"
                       class="text-gray-600 hover:text-blue-600 transition duration-300 {{ request()->routeIs('about') ? 'nav-active' : '' }}">
                        About
                    </a>
                    <a href="{{ route('contact') }}"
                       class="text-gray-600 hover:text-blue-600 transition duration-300 {{ request()->routeIs('contact') ? 'nav-active' : '' }}">
                        Contact
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" id="mobile-menu-button"
                            class="text-gray-600 hover:text-blue-600 focus:outline-none focus:text-blue-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <div class="flex flex-col space-y-3">
                    <a href="{{ route('home') }}"
                       class="text-gray-600 hover:text-blue-600 transition duration-300 {{ request()->routeIs('home') ? 'nav-active' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('projects') }}"
                       class="text-gray-600 hover:text-blue-600 transition duration-300 {{ request()->routeIs('projects') ? 'nav-active' : '' }}">
                        Projects
                    </a>
                    <a href="{{ route('about') }}"
                       class="text-gray-600 hover:text-blue-600 transition duration-300 {{ request()->routeIs('about') ? 'nav-active' : '' }}">
                        About
                    </a>
                    <a href="{{ route('contact') }}"
                       class="text-gray-600 hover:text-blue-600 transition duration-300 {{ request()->routeIs('contact') ? 'nav-active' : '' }}">
                        Contact
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <h3 class="text-xl font-bold mb-4">
                        <i class="fas fa-code text-blue-400 mr-2"></i>
                        Portfolio
                    </h3>
                    <p class="text-gray-300 mb-4">
                        Mahasiswa Teknik Informatika passionate dalam web development, data analysis,
                        dan machine learning.
                    </p>
                    <div class="flex space-x-4">
                        <a href="https://github.com/facchrizhaaripandra" class="text-gray-300 hover:text-white transition duration-300">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition duration-300">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition duration-300">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition duration-300">Home</a></li>
                        <li><a href="{{ route('projects') }}" class="text-gray-300 hover:text-white transition duration-300">Projects</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white transition duration-300">About</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white transition duration-300">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Expertise</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li>Web Development</li>
                        <li>Data Analysis</li>
                        <li>Python Programming</li>
                        <li>Machine Learning</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
                <p>&copy; 2024 Portfolio Teknik Informatika. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>
</html>
