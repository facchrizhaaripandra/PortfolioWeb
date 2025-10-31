<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PortfolioController extends Controller
{
    /**
     * Check if database connection is available
     */
    private function isDatabaseAvailable()
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (\Exception $e) {
            Log::warning('Database connection failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get fallback project data when database is unavailable
     */
    private function getFallbackProjects($limit = null)
    {
        $fallbackProjects = [
            [
                'id' => 1,
                'title' => 'Web Development Project',
                'slug' => 'web-development-project',
                'description' => 'A comprehensive web development project showcasing modern technologies and best practices.',
                'excerpt' => 'Modern web application built with Laravel and React.',
                'project_type' => 'web',
                'technologies' => 'Laravel, PHP, JavaScript, MySQL',
                'github_link' => 'https://github.com',
                'live_demo_link' => 'https://example.com',
                'embed_code' => null,
                'featured_image' => null,
                'gallery_images' => null,
                'is_featured' => true,
                'preview_image_url' => 'https://via.placeholder.com/400x300/4F46E5/FFFFFF?text=Web+Project',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'title' => 'Data Analysis Dashboard',
                'slug' => 'data-analysis-dashboard',
                'description' => 'Interactive data visualization dashboard for business intelligence.',
                'excerpt' => 'Comprehensive data analysis with interactive charts and insights.',
                'project_type' => 'data-analysis',
                'technologies' => 'Python, Pandas, Looker Studio, SQL',
                'github_link' => 'https://github.com',
                'live_demo_link' => 'https://lookerstudio.google.com',
                'embed_code' => null,
                'featured_image' => null,
                'gallery_images' => null,
                'is_featured' => true,
                'preview_image_url' => 'https://via.placeholder.com/400x300/10B981/FFFFFF?text=Data+Analysis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'title' => 'Machine Learning Model',
                'slug' => 'machine-learning-model',
                'description' => 'Advanced machine learning project with computer vision capabilities.',
                'excerpt' => 'AI-powered image recognition and processing system.',
                'project_type' => 'machine-learning',
                'technologies' => 'TensorFlow, Python, OpenCV, Scikit-learn',
                'github_link' => 'https://github.com',
                'live_demo_link' => null,
                'embed_code' => null,
                'featured_image' => null,
                'gallery_images' => null,
                'is_featured' => true,
                'preview_image_url' => 'https://via.placeholder.com/400x300/8B5CF6/FFFFFF?text=ML+Project',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        if ($limit) {
            return array_slice($fallbackProjects, 0, $limit);
        }

        return $fallbackProjects;
    }

    public function home()
    {
        try {
            if ($this->isDatabaseAvailable()) {
                $featuredProjects = Project::where('is_featured', true)
                    ->latest()
                    ->take(3)
                    ->get();
            } else {
                $featuredProjects = collect($this->getFallbackProjects(3))->map(function ($project) {
                    return (object) $project;
                });
            }

            return view('home', compact('featuredProjects'));
        } catch (\Exception $e) {
            Log::error('Error in home method: ' . $e->getMessage());

            // Fallback with static data
            $featuredProjects = collect($this->getFallbackProjects(3))->map(function ($project) {
                return (object) $project;
            });

            return view('home', compact('featuredProjects'));
        }
    }

    public function projects(Request $request)
    {
        try {
            if ($this->isDatabaseAvailable()) {
                $query = Project::query();

                if ($request->has('type')) {
                    $query->where('project_type', $request->type);
                }

                $projects = $query->latest()->paginate(9);
            } else {
                // Fallback to static data
                $allProjects = $this->getFallbackProjects();

                if ($request->has('type')) {
                    $allProjects = array_filter($allProjects, function ($project) use ($request) {
                        return $project['project_type'] === $request->type;
                    });
                }

                $projects = collect($allProjects)->map(function ($project) {
                    return (object) $project;
                });

                // Simple pagination simulation
                $perPage = 9;
                $currentPage = $request->get('page', 1);
                $offset = ($currentPage - 1) * $perPage;
                $paginatedItems = $projects->slice($offset, $perPage);

                $projects = new \Illuminate\Pagination\LengthAwarePaginator(
                    $paginatedItems,
                    $projects->count(),
                    $perPage,
                    $currentPage,
                    ['path' => $request->url(), 'pageName' => 'page']
                );
            }

            $projectTypes = [
                'web' => 'Web Development',
                'data-analysis' => 'Data Analysis',
                'python' => 'Python Projects',
                'machine-learning' => 'Machine Learning'
            ];

            return view('projects', compact('projects', 'projectTypes'));
        } catch (\Exception $e) {
            Log::error('Error in projects method: ' . $e->getMessage());

            // Fallback with static data
            $projects = collect($this->getFallbackProjects())->map(function ($project) {
                return (object) $project;
            });

            $projectTypes = [
                'web' => 'Web Development',
                'data-analysis' => 'Data Analysis',
                'python' => 'Python Projects',
                'machine-learning' => 'Machine Learning'
            ];

            return view('projects', compact('projects', 'projectTypes'));
        }
    }

    public function projectDetail($slug)
    {
        try {
            if ($this->isDatabaseAvailable()) {
                $project = Project::where('slug', $slug)->firstOrFail();
            } else {
                // Find project in fallback data
                $fallbackProjects = $this->getFallbackProjects();
                $projectData = collect($fallbackProjects)->firstWhere('slug', $slug);

                if (!$projectData) {
                    abort(404, 'Project not found');
                }

                $project = (object) $projectData;
            }

            return view('project-detail', compact('project'));
        } catch (\Exception $e) {
            Log::error('Error in projectDetail method: ' . $e->getMessage());

            // Try fallback data
            $fallbackProjects = $this->getFallbackProjects();
            $projectData = collect($fallbackProjects)->firstWhere('slug', $slug);

            if ($projectData) {
                $project = (object) $projectData;
                return view('project-detail', compact('project'));
            }

            // If still not found, show 404
            abort(404, 'Project not found');
        }
    }

    public function about()
    {
        $skills = [
            'Web Development' => [
                'Laravel', 'PHP', 'JavaScript', 'MySQL', 'Bootstrap', 'Tailwind CSS'
            ],
            'Data Analysis' => [
                'Python', 'Pandas', 'Looker Studio', 'SQL', 'Data Visualization'
            ],
            'Python Programming' => [
                'OpenCV', 'Computer Vision', 'Automation', 'Web Scraping'
            ],
            'Machine Learning' => [
                'TensorFlow', 'Scikit-learn', 'CNN', 'Data Preprocessing'
            ]
        ];

        return view('about', compact('skills'));
    }

    public function contact()
    {
        return view('contact');
    }
}
