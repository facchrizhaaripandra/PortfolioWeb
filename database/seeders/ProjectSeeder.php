<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $projects = [
            // Project Website Tracking (Web + ML)
            [
                'title' => 'Website Tracking System - Computer Vision & Web Integration',
                'description' => "Tujuan utama dari project ini adalah untuk menggabungkan teknologi machine learning dengan web-based tracking system, sehingga pengguna dapat:
                                  \n•Mempelajari bagaimana model ML bekerja dalam browser.
                                  \n•Melakukan pelacakan dan klasifikasi gerakan tubuh tanpa backend berat.
                                  \n•Mengimplementasikan hasil pelacakan dengan game gesture-based",
                'excerpt' => 'Integrated web application combining computer vision object tracking with web development',
                'project_type' => 'web', // Bisa juga 'machine-learning' atau buat hybrid
                'technologies' => 'OpenCV,JavaScript,HTML,CSS,Computer Vision,Web Development',
                'github_link' => 'https://github.com/Fff-dot/Website_Tracking.git',
                'live_demo_link' => null, // Tambahkan jika ada demo
                'preview_image_url' => 'https://images.unsplash.com/photo-1555949963-aa79dcee981c?w=600&h=400&fit=crop',
                'is_featured' => true,
            ],

            // Data Analysis Projects
            [
                'title' => 'Analisis Data Penjualan E-commerce 2024',
                'description' => "Dashboard ini menampilkan informasi secara interaktif dan visual agar pemilik usaha dapat memantau performa penjualan, produk, serta persebaran pesanan berdasarkan wilayah dengan mudah.
                                  \nWebsite ini membantu pengguna untuk:
                                  \n•Melihat total harga produk yang terjual, jumlah produk, dan jumlah pesanan secara keseluruhan.
                                  \n•Mengetahui tren penjualan bulanan dalam bentuk grafik.
                                  \n•Menganalisis produk terlaris dan wilayah pembeli terbanyak.
                                  \n•Melakukan penyaringan data berdasarkan nama produk, provinsi, atau rentang tanggal tertentu.",
                'excerpt' => 'Analisis data penjualan dengan visualisasi interaktif dan forecasting',
                'project_type' => 'data-analysis',
                'technologies' => 'Python,Looker Studio,Data Visualization',
                'github_link' => 'https://github.com/username/ecommerce-analysis',
                'embed_code' => '<iframe width="600" height="450" src="https://lookerstudio.google.com/embed/reporting/ff75f2f6-08e4-4e5a-8fcf-da435ed1ee47/page/YJtJF" frameborder="0" style="border:0" allowfullscreen sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"></iframe>',
                'preview_image_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop',
                'is_featured' => true,
            ],

            // Project Game Python dengan Sensor Tangan
            [
                'title' => 'DX Ball Game with Hand Gesture Control',
                'description' => "DX_Ball.py adalah sebuah game interaktif berbasis Python yang terinspirasi dari permainan klasik DX-Ball atau Brick Breaker. Perbedaannya, game ini dikembangkan dengan fitur unik — yaitu kontrol menggunakan sensor tangan melalui teknologi MediaPipe.
                                  \nTujuan dari proyek ini adalah untuk mendemonstrasikan integrasi antara computer vision dan pengembangan game sederhana. Melalui game ini, pengguna dapat memahami bagaimana:
                                  \n•Data landmark tangan dapat dikonversi menjadi input kontrol di dalam game.
                                  \n•Teknologi pelacakan gerakan dapat digunakan untuk membuat sistem interaksi manusia-komputer (Human–Computer Interaction / HCI) yang lebih alami dan menarik.",
                'excerpt' => 'Classic DX Ball game controlled by hand gestures using computer vision and Python',
                'project_type' => 'python',
                'technologies' => 'Python,Pygame,OpenCV,MediaPipe,Computer Vision,Gesture Recognition,Game Development',
                'github_link' => 'https://github.com/Fff-dot/PythonProjects/blob/685d01a7e6eb6dab1ae73d35e70500c2d252d3dd/DX_Ball.py',
                'live_demo_link' => null,
                'preview_image_url' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=600&h=400&fit=crop',
                'is_featured' => true,
            ],
        ];

        foreach ($projects as $projectData) {
            $projectData['slug'] = Str::slug($projectData['title']);
            Project::create($projectData);
        }

        \Log::info("ProjectSeeder: Created " . count($projects) . " projects");
    }
}
