<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'excerpt',
        'project_type',
        'technologies',
        'github_link',
        'live_demo_link',
        'embed_code',
        'featured_image',
        'gallery_images',
        'is_featured',
        'preview_image_url' // Tambahkan field baru
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'is_featured' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function getProjectTypeLabelAttribute()
    {
        return [
            'web' => 'Web Development',
            'data-analysis' => 'Data Analysis',
            'python' => 'Python Projects',
            'machine-learning' => 'Machine Learning'
        ][$this->project_type] ?? 'Other';
    }

    public function getTechnologiesArrayAttribute()
    {
        return explode(',', $this->technologies);
    }

    public function getSafeEmbedCodeAttribute()
    {
        if (!$this->embed_code) {
            return null;
        }

        $allowed_tags = '<iframe><embed><script>';
        return strip_tags($this->embed_code, $allowed_tags);
    }

    public function hasLookerStudioEmbed()
    {
        if (!$this->embed_code || $this->project_type !== 'data-analysis') {
            return false;
        }

        // Cek jika embed code mengandung iframe dengan src Looker Studio
        return Str::contains($this->embed_code, ['lookerstudio.google.com', 'embed/reporting']);
    }

    public function getLookerStudioReportId()
    {
        if (!$this->embed_code) {
            return null;
        }

        // Ekstrak report ID dari embed code
        preg_match('/reporting\/([a-zA-Z0-9_-]+)/', $this->embed_code, $matches);
        return $matches[1] ?? null;
    }

    // Method untuk mendapatkan preview image
    public function getPreviewImageAttribute()
    {
        // Jika ada featured image, gunakan itu
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }

        // Jika ada preview image URL, gunakan itu
        if ($this->preview_image_url) {
            return $this->preview_image_url;
        }

        // Fallback berdasarkan project type
        return $this->getDefaultPreviewImage();
    }

    // Method untuk default preview image berdasarkan project type
    public function getDefaultPreviewImage()
    {
        $defaultImages = [
            'web' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=400&h=300&fit=crop',
            'data-analysis' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&h=300&fit=crop',
            'python' => 'https://images.unsplash.com/photo-1526379879527-8559ecfcaec0?w=400&h=300&fit=crop',
            'machine-learning' => 'https://images.unsplash.com/photo-1555255707-c07966088b7b?w=400&h=300&fit=crop'
        ];

        return $defaultImages[$this->project_type] ?? 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?w=400&h=300&fit=crop';
    }

    public function getLookerStudioPreviewImage()
    {
        $reportId = $this->getLookerStudioReportId();
        if (!$reportId) {
            return null;
        }

        // Generate preview image URL (ini adalah placeholder)
        return "https://via.placeholder.com/800x600/3B82F6/FFFFFF?text=Looker+Studio+Dashboard+Preview";
    }

    // Method untuk mengekstrak preview dari Looker Studio embed
    public function getLookerStudioPreviewUrl()
    {
        if (!$this->embed_code) {
            return null;
        }

        // Ekstrak report ID dari embed code
        preg_match('/reporting\/([a-zA-Z0-9_-]+)/', $this->embed_code, $matches);

        if (isset($matches[1])) {
            $reportId = $matches[1];
            // Generate preview URL untuk Looker Studio
            return "https://lookerstudio.google.com/embed/reporting/{$reportId}/preview";
        }

        return null;
    }
    public function shouldShowEmbed()
    {
        if (!$this->hasLookerStudioEmbed()) {
            return false;
        }

        // Untuk demo, kita selalu show embed
        // Di production, bisa ditambahkan logic berdasarkan environment
        return true;
    }
    // Method untuk mengecek apakah project hybrid (Web + ML)
    public function isHybridProject()
    {
        $webTechs = ['laravel', 'php', 'javascript', 'html', 'css', 'bootstrap'];
        $mlTechs = ['python', 'opencv', 'yolo', 'tensorflow', 'machine learning', 'computer vision'];

        $technologies = strtolower($this->technologies);

        $hasWeb = Str::contains($technologies, $webTechs);
        $hasML = Str::contains($technologies, $mlTechs);

        return $hasWeb && $hasML;
    }

    // Method untuk mendapatkan badge type
    public function getProjectBadgeAttribute()
    {
        if ($this->isHybridProject()) {
            return 'Hybrid';
        }

        return $this->project_type_label;
    }

    // Method untuk mendapatkan badge color
    public function getProjectBadgeColorAttribute()
    {
        if ($this->isHybridProject()) {
            return 'bg-gradient-to-r from-purple-500 to-pink-500';
        }

        $colors = [
            'web' => 'bg-blue-100 text-blue-600',
            'data-analysis' => 'bg-green-100 text-green-600',
            'python' => 'bg-yellow-100 text-yellow-600',
            'machine-learning' => 'bg-purple-100 text-purple-600'
        ];

        return $colors[$this->project_type] ?? 'bg-gray-100 text-gray-600';
    }
    // Method untuk mengecek apakah project game
    public function isGameProject()
    {
        $gameKeywords = ['game', 'pygame', 'arcade', 'control', 'gesture'];
        $title = strtolower($this->title);
        $technologies = strtolower($this->technologies);

        foreach ($gameKeywords as $keyword) {
            if (Str::contains($title, $keyword) || Str::contains($technologies, $keyword)) {
                return true;
            }
        }

        return false;
    }

    // Method untuk mendapatkan icon berdasarkan project type
    public function getProjectIconAttribute()
    {
        if ($this->isGameProject()) {
            return 'fa-gamepad';
        }

        if ($this->isHybridProject()) {
            return 'fa-code-branch';
        }

        $icons = [
            'web' => 'fa-globe',
            'data-analysis' => 'fa-chart-bar',
            'python' => 'fa-code',
            'machine-learning' => 'fa-brain'
        ];

        return $icons[$this->project_type] ?? 'fa-project-diagram';
    }

    // Method untuk mendapatkan accent color
    public function getProjectAccentColorAttribute()
    {
        if ($this->isGameProject()) {
            return 'red';
        }

        if ($this->isHybridProject()) {
            return 'purple';
        }

        $colors = [
            'web' => 'blue',
            'data-analysis' => 'green',
            'python' => 'yellow',
            'machine-learning' => 'purple'
        ];

        return $colors[$this->project_type] ?? 'gray';
    }
}
