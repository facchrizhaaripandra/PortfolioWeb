@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="gradient-bg text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-6">Fachrizha Rifky Aripandra</h1>
        <p class="text-xl mb-8">Specializing in Web Development, Data Analysis, Python, and Machine Learning</p>
        <a href="{{ route('projects') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
            View My Work
        </a>
    </div>
</section>

<!-- Skills Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Areas of Expertise</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center p-6 hover-scale">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fab fa-laravel text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Web Development</h3>
                <p class="text-gray-600">Laravel, PHP, JavaScript, MySQL</p>
            </div>
            <div class="text-center p-6 hover-scale">
                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-bar text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Data Analysis</h3>
                <p class="text-gray-600">Looker Studio, Python, Pandas, Visualization</p>
            </div>
            <div class="text-center p-6 hover-scale">
                <div class="bg-yellow-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fab fa-python text-yellow-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Python Projects</h3>
                <p class="text-gray-600">Object Tracking, Automation, Scripting</p>
            </div>
            <div class="text-center p-6 hover-scale">
                <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-brain text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Machine Learning</h3>
                <p class="text-gray-600">TensorFlow, Scikit-learn, Data Mining</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Projects -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Featured Projects</h2>

        @if($featuredProjects->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($featuredProjects as $project)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale border border-gray-200">
                    <div class="relative w-full h-48 bg-gray-100 overflow-hidden">
                        <img src="{{ $project->preview_image }}"
                             alt="{{ $project->title }}"
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                             onerror="this.src='{{ $project->default_preview_image }}'">

                        <div class="absolute top-3 left-3">
                            <span class="inline-block bg-blue-600 text-white text-xs px-2 py-1 rounded-full">
                                {{ $project->project_type_label }}
                            </span>
                        </div>

                        @if($project->project_type === 'data-analysis')
                        <div class="absolute bottom-3 right-3">
                            <div class="bg-green-500 text-white p-2 rounded-full shadow-lg">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">{{ $project->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ $project->excerpt }}</p>
                        <a href="{{ route('project.detail', $project->slug) }}" class="text-blue-600 hover:text-blue-800 font-semibold inline-flex items-center">
                            View Project <i class="fas fa-arrow-right ml-1 text-sm"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-inbox text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-600 mb-2">No Featured Projects Yet</h3>
                <p class="text-gray-500 mb-6">Projects are being prepared. Please check back soon!</p>
            </div>
        @endif

        <div class="text-center mt-8">
            <a href="{{ route('projects') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 inline-flex items-center">
                View All Projects <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>
@endsection
