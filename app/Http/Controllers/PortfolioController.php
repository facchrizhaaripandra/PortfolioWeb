<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function home()
    {
        $featuredProjects = Project::where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact('featuredProjects'));
    }

    public function projects(Request $request)
    {
        $query = Project::query();

        if ($request->has('type')) {
            $query->where('project_type', $request->type);
        }

        $projects = $query->latest()->paginate(9);

        $projectTypes = [
            'web' => 'Web Development',
            'data-analysis' => 'Data Analysis',
            'python' => 'Python Projects',
            'machine-learning' => 'Machine Learning'
        ];

        return view('projects', compact('projects', 'projectTypes'));
    }

    public function projectDetail($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        return view('project-detail', compact('project'));
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
