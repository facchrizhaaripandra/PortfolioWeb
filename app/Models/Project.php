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
        'preview_image_url',
        'gallery_images',
        'is_featured'
    ];

    protected $casts = [
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
        return $this->embed_code && $this->project_type === 'data-analysis';
    }

    public function getPreviewImageAttribute()
    {
        if ($this->preview_image_url) {
            return $this->preview_image_url;
        }

        return $this->getDefaultPreviewImage();
    }

    public function getDefaultPreviewImageAttribute()
    {
        $defaultImages = [
            'web' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=400&h=300&fit=crop',
            'data-analysis' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&h=300&fit=crop',
            'python' => 'https://images.unsplash.com/photo-1526379879527-8559ecfcaec0?w=400&h=300&fit=crop',
            'machine-learning' => 'https://images.unsplash.com/photo-1555255707-c07966088b7b?w=400&h=300&fit=crop'
        ];

        return $defaultImages[$this->project_type] ?? 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?w=400&h=300&fit=crop';
    }

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

    public function getProjectIconAttribute()
    {
        if ($this->isGameProject()) {
            return 'fa-gamepad';
        }

        $icons = [
            'web' => 'fa-globe',
            'data-analysis' => 'fa-chart-bar',
            'python' => 'fa-code',
            'machine-learning' => 'fa-brain'
        ];

        return $icons[$this->project_type] ?? 'fa-project-diagram';
    }

    public function getProjectBadgeColorAttribute()
    {
        if ($this->isGameProject()) {
            return 'bg-red-100 text-red-600';
        }

        $colors = [
            'web' => 'bg-blue-100 text-blue-600',
            'data-analysis' => 'bg-green-100 text-green-600',
            'python' => 'bg-yellow-100 text-yellow-600',
            'machine-learning' => 'bg-purple-100 text-purple-600'
        ];

        return $colors[$this->project_type] ?? 'bg-gray-100 text-gray-600';
    }

    public function getProjectBadgeAttribute()
    {
        if ($this->isGameProject()) {
            return 'Game';
        }

        return $this->project_type_label;
    }
}
