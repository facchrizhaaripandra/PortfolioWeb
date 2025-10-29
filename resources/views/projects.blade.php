@extends('layouts.app')

@section('title', 'My Projects')

@section('content')
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">My Projects</h1>
            <p class="text-xl text-gray-600">Explore my work in web development, data analysis, and machine learning</p>
        </div>

        <!-- Filter Buttons -->
        <div class="flex flex-wrap justify-center gap-3 mb-8">
            <a href="{{ route('projects') }}"
               class="px-5 py-2.5 rounded-full {{ !request('type') ? 'bg-blue-600 text-white shadow-lg' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition duration-300 font-medium">
                All Projects
            </a>
            @foreach($projectTypes as $key => $type)
            <a href="{{ route('projects', ['type' => $key]) }}"
               class="px-5 py-2.5 rounded-full {{ request('type') == $key ? 'bg-blue-600 text-white shadow-lg' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition duration-300 font-medium">
                {{ $type }}
            </a>
            @endforeach
        </div>

        <!-- Projects Counter -->
        <div class="text-center mb-8">
            <p class="text-gray-600 text-lg">
                @if(request('type'))
                    Showing {{ $projects->count() }} {{ strtolower($projectTypes[request('type')] ?? request('type')) }} project{{ $projects->count() !== 1 ? 's' : '' }}
                @else
                    Showing {{ $projects->count() }} of {{ $projects->total() }} project{{ $projects->total() !== 1 ? 's' : '' }}
                @endif
            </p>
        </div>

        <!-- Projects Grid -->
        @if($projects->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover-scale border border-gray-200">
                    <!-- Project Image -->
                    <div class="relative h-48 bg-gray-100 overflow-hidden">
                        <img src="{{ $project->preview_image }}"
                            alt="{{ $project->title }}"
                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                            onerror="this.src='https://images.unsplash.com/photo-1620712943543-bcc4688e7485?w=600&h=400&fit=crop'">

                        <!-- Project Type Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="inline-block {{ $project->project_badge_color }} text-xs px-2 py-1 rounded-full shadow-md">
                                <i class="fas {{ $project->project_icon }} mr-1"></i>
                                {{ $project->project_badge }}
                            </span>
                        </div>

                        <!-- Game Project Special Badge -->
                        @if($project->isGameProject())
                        <div class="absolute top-3 right-3">
                            <span class="inline-block bg-red-100 text-red-600 text-xs px-2 py-1 rounded-full shadow-md">
                                <i class="fas fa-gamepad mr-1"></i> Interactive
                            </span>
                        </div>
                        @endif

                        <!-- Featured Badge -->
                        @if($project->is_featured)
                        <div class="absolute bottom-3 left-3">
                            <span class="inline-block bg-yellow-100 text-yellow-600 text-xs px-2 py-1 rounded-full shadow-md">
                                <i class="fas fa-star mr-1"></i> Featured
                            </span>
                        </div>
                        @endif

                        <!-- Game Project Hover Overlay -->
                        @if($project->isGameProject())
                        <div class="absolute inset-0 bg-red-900 bg-opacity-0 hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                            <div class="text-white text-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                                <i class="fas fa-hand-paper text-2xl mb-2"></i>
                                <p class="text-sm font-semibold">Hand Control Game</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Project Content -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $project->title }}</h3>
                        <p class="text-gray-600 mb-4 text-sm leading-relaxed">{{ $project->excerpt }}</p>

                        <!-- Technologies -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach($project->technologies_array as $tech)
                            <span class="bg-gray-100 text-gray-700 text-xs px-3 py-1.5 rounded-lg border border-gray-300">
                                {{ $tech }}
                            </span>
                            @endforeach
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                            <a href="{{ route('project.detail', $project->slug) }}"
                               class="text-blue-600 hover:text-blue-800 font-semibold text-sm flex items-center group">
                                View Details
                                <i class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform duration-300"></i>
                            </a>
                            <div class="flex space-x-3">
                                @if($project->github_link)
                                <a href="{{ $project->github_link }}" target="_blank"
                                   class="text-gray-500 hover:text-gray-700 transition duration-300 transform hover:scale-110"
                                   title="Source Code">
                                    <i class="fab fa-github text-lg"></i>
                                </a>
                                @endif
                                @if($project->live_demo_link)
                                <a href="{{ $project->live_demo_link }}" target="_blank"
                                   class="text-gray-500 hover:text-green-600 transition duration-300 transform hover:scale-110"
                                   title="Live Demo">
                                    <i class="fas fa-external-link-alt text-lg"></i>
                                </a>
                                @endif
                                @if($project->isGameProject())
                                <span class="text-gray-400 transform hover:scale-110 transition duration-300" title="Game Project">
                                    <i class="fas fa-gamepad text-lg"></i>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($projects->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $projects->links() }}
            </div>
            @endif

        @else
            <!-- No Projects Found -->
            <div class="text-center py-16">
                <div class="bg-gray-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-search text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-600 mb-3">No Projects Found</h3>
                <p class="text-gray-500 mb-6 max-w-md mx-auto">
                    @if(request('type'))
                        No {{ strtolower($projectTypes[request('type')] ?? request('type')) }} projects found at the moment.
                    @else
                        No projects available. Please check back later.
                    @endif
                </p>
                <a href="{{ route('projects') }}"
                   class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition duration-300 inline-flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to All Projects
                </a>
            </div>
        @endif
    </div>
</section>

<style>
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
    padding: 0.75rem 1.25rem;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    color: #374151;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
}

.pagination li a:hover {
    background-color: #3b82f6;
    color: white;
    border-color: #3b82f6;
    transform: translateY(-2px);
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

.hover-scale {
    transition: transform 0.3s ease;
}

.hover-scale:hover {
    transform: translateY(-5px);
}
</style>
@endsection
