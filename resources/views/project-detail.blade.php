@extends('layouts.app')

@section('title', $project->title)

@section('content')
<section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        <div class="mb-8">
            <span class="inline-block bg-blue-100 text-blue-600 text-sm px-3 py-1 rounded-full mb-4">
                {{ $project->project_type_label }}
            </span>
            <h1 class="text-4xl font-bold mb-4">{{ $project->title }}</h1>

            <!-- Preview Image -->
            <div class="w-full h-64 bg-gray-100 rounded-lg mb-6 overflow-hidden">
                <img src="{{ $project->preview_image }}"
                     alt="{{ $project->title }}"
                     class="w-full h-full object-cover">
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="prose max-w-none mb-8">
                    <div class="bg-white p-6 rounded-lg border border-gray-200">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </div>

                @if(Str::contains(strtolower($project->title), 'tracking') || Str::contains(strtolower($project->technologies), 'opencv'))
                <!-- Special Section untuk Computer Vision Projects -->
                <div class="mb-8">
                    <h3 class="text-2xl font-semibold mb-6 flex items-center">
                        <i class="fas fa-eye text-green-600 mr-3"></i>
                        Computer Vision Features
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-gradient-to-br from-green-50 to-blue-50 rounded-lg p-6 border border-green-200">
                            <div class="flex items-center mb-4">
                                <div class="bg-green-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-video text-green-600"></i>
                                </div>
                                <h4 class="font-semibold text-gray-800">Real-time Tracking</h4>
                            </div>
                            <p class="text-gray-600 text-sm">Live object detection and tracking using computer vision algorithms</p>
                        </div>

                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-lg p-6 border border-purple-200">
                            <div class="flex items-center mb-4">
                                <div class="bg-purple-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-brain text-purple-600"></i>
                                </div>
                                <h4 class="font-semibold text-gray-800">ML Integration</h4>
                            </div>
                            <p class="text-gray-600 text-sm">YOLO model for accurate object detection and recognition</p>
                        </div>
                    </div>

                    <!-- Architecture Diagram -->
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                        <h4 class="text-lg font-semibold mb-4 text-center">System Architecture</h4>
                        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                            <div class="text-center">
                                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-desktop text-blue-600"></i>
                                </div>
                                <p class="text-sm font-semibold">Web Interface</p>
                                <p class="text-xs text-gray-500">HTML/CSS/JS</p>
                            </div>
                            <div class="text-center">
                                <i class="fas fa-arrow-right text-gray-400 text-xl"></i>
                            </div>
                            <div class="text-center">
                                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-server text-green-600"></i>
                                </div>
                                <p class="text-sm font-semibold">Flask Backend</p>
                                <p class="text-xs text-gray-500">Python API</p>
                            </div>
                            <div class="text-center">
                                <i class="fas fa-arrow-right text-gray-400 text-xl"></i>
                            </div>
                            <div class="text-center">
                                <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-robot text-purple-600"></i>
                                </div>
                                <p class="text-sm font-semibold">ML Model</p>
                                <p class="text-xs text-gray-500">OpenCV + YOLO</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Data Analysis Dashboard Section -->
                @if($project->project_type === 'data-analysis')
                <div class="mb-8" id="dashboard">
                    <h3 class="text-2xl font-semibold mb-6 flex items-center">
                        <i class="fas fa-chart-bar text-blue-600 mr-3"></i>
                        Data Analysis Dashboard
                    </h3>

                    @if($project->hasLookerStudioEmbed() && $project->shouldShowEmbed())
                        <!-- Jika ada embed code valid -->
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-lg font-semibold text-gray-800">Interactive Dashboard</h4>
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                    <i class="fas fa-circle mr-1"></i> Live Data
                                </span>
                            </div>

                            <div class="bg-white rounded-lg border border-gray-300 overflow-hidden">
                                <!-- Embed Container -->
                                <div class="p-4">
                                    {!! $project->safe_embed_code !!}
                                </div>

                                <div class="bg-gray-50 px-4 py-3 border-t border-gray-200">
                                    <div class="flex items-center justify-between text-sm text-gray-600">
                                        <div class="flex items-center">
                                            <i class="fab fa-google mr-2 text-blue-600"></i>
                                            <span>Powered by Looker Studio</span>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <span class="flex items-center">
                                                <i class="fas fa-sync-alt mr-1 text-green-600"></i>
                                                Real-time
                                            </span>
                                            <span class="flex items-center">
                                                <i class="fas fa-filter mr-1 text-purple-600"></i>
                                                Interactive
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($project->embed_code)
                        <!-- Jika ada custom embed code (HTML) -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-2 border border-blue-200">
                            {!! $project->embed_code !!}
                        </div>
                    @else
                        <!-- Fallback untuk data analysis tanpa embed -->
                        <div class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-lg p-8 text-center border border-gray-200">
                            <div class="max-w-md mx-auto">
                                <div class="bg-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                                    <i class="fas fa-chart-bar text-blue-600 text-xl"></i>
                                </div>
                                <h4 class="text-xl font-semibold text-gray-800 mb-3">Data Analysis Dashboard</h4>
                                <p class="text-gray-600 mb-4">This project includes comprehensive data analysis with interactive visualizations.</p>

                                <div class="grid grid-cols-2 gap-3 mb-6">
                                    <div class="bg-white rounded-lg p-3 text-center shadow-sm">
                                        <i class="fas fa-database text-blue-500 text-lg mb-1"></i>
                                        <p class="text-xs text-gray-600">Data Processing</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 text-center shadow-sm">
                                        <i class="fas fa-chart-line text-green-500 text-lg mb-1"></i>
                                        <p class="text-xs text-gray-600">Analytics</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 text-center shadow-sm">
                                        <i class="fas fa-table text-purple-500 text-lg mb-1"></i>
                                        <p class="text-xs text-gray-600">Reports</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 text-center shadow-sm">
                                        <i class="fas fa-search text-orange-500 text-lg mb-1"></i>
                                        <p class="text-xs text-gray-600">Insights</p>
                                    </div>
                                </div>

                                <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                                    <p class="text-blue-700 text-sm">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Detailed analysis and visualizations available in the project documentation
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @endif

                @if(Str::contains(strtolower($project->title), 'game') || Str::contains(strtolower($project->technologies), 'pygame'))
                <!-- Special Section untuk Game Projects -->
                <div class="mb-8">
                    <h3 class="text-2xl font-semibold mb-6 flex items-center">
                        <i class="fas fa-gamepad text-red-600 mr-3"></i>
                        Game Features & Controls
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-gradient-to-br from-red-50 to-orange-50 rounded-lg p-6 border border-red-200">
                            <div class="flex items-center mb-4">
                                <div class="bg-red-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-hand-paper text-red-600"></i>
                                </div>
                                <h4 class="font-semibold text-gray-800">Hand Gesture Control</h4>
                            </div>
                            <p class="text-gray-600 text-sm mb-3">Control the game using natural hand movements without any physical controller</p>
                            <ul class="text-xs text-gray-500 space-y-1">
                                <li>• Move hand left/right to control paddle</li>
                                <li>• Real-time hand tracking with webcam</li>
                                <li>• No additional hardware required</li>
                            </ul>
                        </div>

                        <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-lg p-6 border border-blue-200">
                            <div class="flex items-center mb-4">
                                <div class="bg-blue-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-eye text-blue-600"></i>
                                </div>
                                <h4 class="font-semibold text-gray-800">Computer Vision</h4>
                            </div>
                            <p class="text-gray-600 text-sm mb-3">Advanced hand detection using MediaPipe with 21 landmark points</p>
                            <ul class="text-xs text-gray-500 space-y-1">
                                <li>• MediaPipe Hands for accurate tracking</li>
                                <li>• OpenCV for video processing</li>
                                <li>• Real-time performance (30+ FPS)</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Game Architecture -->
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200 mb-6">
                        <h4 class="text-lg font-semibold mb-4 text-center">Game System Architecture</h4>
                        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                            <div class="text-center">
                                <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-video text-red-600"></i>
                                </div>
                                <p class="text-sm font-semibold">Webcam Input</p>
                                <p class="text-xs text-gray-500">Video Feed</p>
                            </div>
                            <div class="text-center">
                                <i class="fas fa-arrow-right text-gray-400 text-xl"></i>
                            </div>
                            <div class="text-center">
                                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-hand-paper text-green-600"></i>
                                </div>
                                <p class="text-sm font-semibold">Hand Detection</p>
                                <p class="text-xs text-gray-500">MediaPipe</p>
                            </div>
                            <div class="text-center">
                                <i class="fas fa-arrow-right text-gray-400 text-xl"></i>
                            </div>
                            <div class="text-center">
                                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-gamepad text-blue-600"></i>
                                </div>
                                <p class="text-sm font-semibold">Game Logic</p>
                                <p class="text-xs text-gray-500">Pygame</p>
                            </div>
                            <div class="text-center">
                                <i class="fas fa-arrow-right text-gray-400 text-xl"></i>
                            </div>
                            <div class="text-center">
                                <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-tv text-purple-600"></i>
                                </div>
                                <p class="text-sm font-semibold">Game Display</p>
                                <p class="text-xs text-gray-500">Graphics</p>
                            </div>
                        </div>
                    </div>

                    <!-- Gameplay Instructions -->
                    <div class="bg-yellow-50 rounded-lg p-6 border border-yellow-200">
                        <h4 class="text-lg font-semibold mb-3 flex items-center text-yellow-800">
                            <i class="fas fa-info-circle mr-2"></i>
                            How to Play
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h5 class="font-semibold text-yellow-700 mb-2">Setup Requirements:</h5>
                                <ul class="text-sm text-yellow-600 space-y-1">
                                    <li>• Webcam connected to computer</li>
                                    <li>• Good lighting conditions</li>
                                    <li>• Python 3.7+ installed</li>
                                    <li>• Required libraries: Pygame, OpenCV, MediaPipe</li>
                                </ul>
                            </div>
                            <div>
                                <h5 class="font-semibold text-yellow-700 mb-2">Game Controls:</h5>
                                <ul class="text-sm text-yellow-600 space-y-1">
                                    <li>• Move hand horizontally to control paddle</li>
                                    <li>• Keep hand in camera frame</li>
                                    <li>• Adjust distance for sensitivity</li>
                                    <li>• Close fist for special actions</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-gray-50 rounded-lg p-6 sticky top-8">
                    <h3 class="text-xl font-semibold mb-4">Project Details</h3>

                    <!-- Project Type -->
                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Project Type</h4>
                        <span class="inline-block bg-blue-600 text-white text-sm px-3 py-1 rounded-full">
                            {{ $project->project_type_label }}
                        </span>
                    </div>

                    <!-- Technologies -->
                    <div class="mb-6">
                        <h4 class="font-semibold mb-2">Technologies Used</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($project->technologies_array as $tech)
                            <span class="bg-white text-gray-700 text-sm px-3 py-1 rounded border border-gray-300 shadow-sm">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Project Links -->
                    <div class="space-y-3">
                        @if($project->github_link)
                        <a href="{{ $project->github_link }}" target="_blank" class="flex items-center text-gray-700 hover:text-gray-900 bg-white p-3 rounded-lg border border-gray-200 transition duration-300 shadow-sm">
                            <i class="fab fa-github text-xl mr-3 text-gray-600"></i>
                            <div>
                                <span class="font-semibold block">Source Code</span>
                                <span class="text-xs text-gray-500">View on GitHub</span>
                            </div>
                        </a>
                        @endif

                        @if($project->live_demo_link)
                        <a href="{{ $project->live_demo_link }}" target="_blank" class="flex items-center text-gray-700 hover:text-green-600 bg-white p-3 rounded-lg border border-gray-200 transition duration-300 shadow-sm">
                            <i class="fas fa-external-link-alt text-xl mr-3 text-gray-600"></i>
                            <div>
                                <span class="font-semibold block">Live Demo</span>
                                <span class="text-xs text-gray-500">Try it out</span>
                            </div>
                        </a>
                        @endif

                        @if($project->project_type === 'data-analysis')
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                            <div class="flex items-start">
                                <i class="fas fa-chart-bar text-blue-600 text-lg mr-3 mt-1"></i>
                                <div>
                                    <span class="font-semibold text-blue-700 block">Data Analytics</span>
                                    <span class="text-xs text-blue-600">Interactive dashboards and insights</span>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.embed-container {
    position: relative;
    width: 100%;
    min-height: 400px;
    border-radius: 8px;
    overflow: hidden;
}

.embed-container iframe {
    width: 100%;
    height: 600px;
    border: none;
    border-radius: 8px;
}
</style>
@endsection
