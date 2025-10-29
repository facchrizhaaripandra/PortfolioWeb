@extends('layouts.app')

@section('title', 'About Me')

@section('content')
<section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-gray-800 mb-6">About Me</h1>
            <div class="max-w-3xl mx-auto">
                <p class="text-xl text-gray-600 mb-6">
                    Saya adalah mahasiswa Teknik Informatika yang passionate dalam pengembangan web, analisis data,
                    dan machine learning. Memiliki ketertarikan khusus dalam membuat solusi teknologi yang impactful.
                </p>
                <div class="flex justify-center space-x-4">
                    <span class="bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold">
                        Web Development
                    </span>
                    <span class="bg-green-100 text-green-600 px-4 py-2 rounded-full text-sm font-semibold">
                        Data Analysis
                    </span>
                    <span class="bg-purple-100 text-purple-600 px-4 py-2 rounded-full text-sm font-semibold">
                        Machine Learning
                    </span>
                </div>
            </div>
        </div>

        <!-- Skills Section -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-center mb-12">Skills & Technologies</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($skills as $category => $items)
                <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800 flex items-center">
                        @switch($category)
                            @case('Web Development')
                                <i class="fas fa-code text-blue-600 mr-3"></i>
                                @break
                            @case('Data Analysis')
                                <i class="fas fa-chart-bar text-green-600 mr-3"></i>
                                @break
                            @case('Python Programming')
                                <i class="fab fa-python text-yellow-600 mr-3"></i>
                                @break
                            @case('Machine Learning')
                                <i class="fas fa-brain text-purple-600 mr-3"></i>
                                @break
                        @endswitch
                        {{ $category }}
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($items as $skill)
                        <span class="bg-white text-gray-700 px-3 py-1 rounded-full border border-gray-300 text-sm">
                            {{ $skill }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Education & Interests -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Education -->
            <div>
                <h2 class="text-2xl font-bold mb-6 flex items-center">
                    <i class="fas fa-graduation-cap text-blue-600 mr-3"></i>
                    Education
                </h2>
                <div class="space-y-6">
                    <div class="bg-white border-l-4 border-blue-500 pl-6 py-4">
                        <h3 class="font-semibold text-gray-800">Teknik Informatika</h3>
                        <p class="text-gray-600">Universitas Mercu Buana</p>
                        <p class="text-gray-500 text-sm">2023 - Sekarang</p>
                        <p class="text-gray-600 mt-2">Fokus pada pengembangan web, analisis data, dan machine learning.</p>
                    </div>
                </div>
            </div>

            <!-- Interests -->
            <div>
                <h2 class="text-2xl font-bold mb-6 flex items-center">
                    <i class="fas fa-heart text-red-600 mr-3"></i>
                    Interests
                </h2>
                <div class="space-y-4">
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <i class="fas fa-laptop-code text-blue-600 text-xl mr-4"></i>
                        <div>
                            <h4 class="font-semibold">Web Development</h4>
                            <p class="text-gray-600 text-sm">Membangun aplikasi web menggunakan Laravel dan modern technologies</p>
                        </div>
                    </div>
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <i class="fas fa-chart-line text-green-600 text-xl mr-4"></i>
                        <div>
                            <h4 class="font-semibold">Data Analysis</h4>
                            <p class="text-gray-600 text-sm">Analisis data dan visualisasi dengan Python dan Looker Studio</p>
                        </div>
                    </div>
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <i class="fas fa-robot text-purple-600 text-xl mr-4"></i>
                        <div>
                            <h4 class="font-semibold">AI & Machine Learning</h4>
                            <p class="text-gray-600 text-sm">Mengembangkan model machine learning untuk berbagai aplikasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
