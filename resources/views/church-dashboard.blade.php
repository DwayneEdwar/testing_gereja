<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $churchInfo->nama_gereja ?? 'Dashboard Gereja' }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
        .font-heading {
            font-family: 'Cinzel', serif;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        
        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 50%, #b45309 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .stat-card {
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .pattern-dots {
            background-image: radial-gradient(circle, rgba(251, 191, 36, 0.15) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        
        .hero-overlay {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.95) 0%, rgba(217, 119, 6, 0.95) 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    
    {{-- Navigation --}}
    <nav class="bg-white/95 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b border-amber-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-amber-400 to-orange-600 rounded-xl blur opacity-75 animate-pulse"></div>
                        <div class="relative w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <span class="font-heading text-xl font-bold bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">
                            {{ $churchInfo->nama_gereja ?? 'Sistem Gereja' }}
                        </span>
                        <p class="text-xs text-gray-500">Sistem Informasi Jemaat</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-amber-600 transition-colors font-medium">
                            Dashboard
                        </a>
                        <a href="/admin" class="px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-xl hover:from-amber-600 hover:to-orange-700 transition-all shadow-lg hover:shadow-xl text-sm font-semibold">
                            Admin Panel
                        </a>
                    @else
                        <a href="/admin/login" class="px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-xl hover:from-amber-600 hover:to-orange-700 transition-all shadow-lg hover:shadow-xl text-sm font-semibold">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    @if($churchInfo)
    <section class="relative overflow-hidden">
        {{-- Background Image with Overlay --}}
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1551677592-2eccad8669a8?crop=entropy&cs=srgb&fm=jpg&q=85" 
                 alt="Church community - Photo by MD Duran on Unsplash" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 hero-overlay"></div>
        </div>
        
        {{-- Decorative Elements --}}
        <div class="absolute inset-0 pattern-dots opacity-30"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center mb-12 animate-fadeInUp">
                <div class="inline-block mb-4">
                    <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-white text-sm font-semibold border border-white/30">
                        Selamat Datang
                    </span>
                </div>
                <h1 class="font-heading text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                    {{ $churchInfo->nama_gereja }}
                </h1>
                <p class="text-2xl text-amber-100 max-w-3xl mx-auto leading-relaxed">
                    Bersama Membangun Komunitas yang Kuat dalam Iman dan Kasih
                </p>
            </div>
            
            {{-- Church Info Cards --}}
            <div class="max-w-5xl mx-auto">
                <div class="grid md:grid-cols-3 gap-6 mb-8">
                    {{-- Address Card --}}
                    <div class="glass-effect rounded-2xl p-6 hover:bg-white/20 transition-all group">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs font-semibold text-amber-200 uppercase tracking-wider mb-1">Alamat</p>
                                <p class="text-white font-medium text-sm leading-snug">{{ $churchInfo->alamat }}</p>
                            </div>
                        </div>
                    </div>
                    
                    @if($churchInfo->gembala_jemaat)
                    {{-- Pastor Card --}}
                    <div class="glass-effect rounded-2xl p-6 hover:bg-white/20 transition-all group">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs font-semibold text-amber-200 uppercase tracking-wider mb-1">Gembala Jemaat</p>
                                <p class="text-white font-medium text-sm">{{ $churchInfo->gembala_jemaat }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if($churchInfo->kontak_gereja)
                    {{-- Contact Card --}}
                    <div class="glass-effect rounded-2xl p-6 hover:bg-white/20 transition-all group">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs font-semibold text-amber-200 uppercase tracking-wider mb-1">Kontak</p>
                                <p class="text-white font-medium text-sm">{{ $churchInfo->kontak_gereja }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                
                @if($churchInfo->deskripsi)
                <div class="glass-effect rounded-2xl p-8 text-center">
                    <p class="text-white/95 text-lg leading-relaxed">{{ $churchInfo->deskripsi }}</p>
                </div>
                @endif
            </div>
        </div>
        
        {{-- Wave Separator --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
            </svg>
        </div>
    </section>
    @endif

    {{-- Statistics Section --}}
    <section class="py-20 bg-white relative overflow-hidden">
        {{-- Background Decoration --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-amber-100 to-orange-100 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-tr from-blue-100 to-purple-100 rounded-full blur-3xl opacity-50"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-amber-100 text-amber-800 rounded-full text-sm font-semibold mb-4">
                    Statistik Terkini
                </span>
                <h2 class="font-heading text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Data Jemaat & Pelayanan
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Transparansi dan akuntabilitas dalam setiap aspek pelayanan
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Total Jemaat --}}
                <div class="stat-card bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-8 shadow-xl">
                    <div class="flex items-start justify-between mb-6">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-blue-100 text-sm font-semibold uppercase tracking-wider mb-2">Total Jemaat</p>
                    <p class="text-5xl font-bold text-white mb-2">{{ number_format($stats['total_jemaat']) }}</p>
                    <p class="text-blue-100 text-sm">Anggota jemaat terdaftar</p>
                </div>
                
                {{-- Total Kelompok --}}
                <div class="stat-card bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-8 shadow-xl">
                    <div class="flex items-start justify-between mb-6">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-green-100 text-sm font-semibold uppercase tracking-wider mb-2">Kelompok</p>
                    <p class="text-5xl font-bold text-white mb-2">{{ number_format($stats['total_kelompok']) }}</p>
                    <p class="text-green-100 text-sm">Kelompok ibadah aktif</p>
                </div>
                
                {{-- Total Pelka --}}
                <div class="stat-card bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-8 shadow-xl">
                    <div class="flex items-start justify-between mb-6">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-purple-100 text-sm font-semibold uppercase tracking-wider mb-2">Pelayanan</p>
                    <p class="text-5xl font-bold text-white mb-2">{{ number_format($stats['total_pelka']) }}</p>
                    <p class="text-purple-100 text-sm">Pelayanan kategorial</p>
                </div>
                
                {{-- Sudah Baptis --}}
                <div class="stat-card bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl p-8 shadow-xl">
                    <div class="flex items-start justify-between mb-6">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-amber-100 text-sm font-semibold uppercase tracking-wider mb-2">Sudah Baptis</p>
                    <p class="text-5xl font-bold text-white mb-2">{{ number_format($stats['sudah_baptis']) }}</p>
                    <p class="text-amber-100 text-sm">Jemaat dengan dokumen baptis</p>
                </div>
                
                {{-- Sudah Sidi --}}
                <div class="stat-card bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl p-8 shadow-xl">
                    <div class="flex items-start justify-between mb-6">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-teal-100 text-sm font-semibold uppercase tracking-wider mb-2">Sudah Sidi</p>
                    <p class="text-5xl font-bold text-white mb-2">{{ number_format($stats['sudah_sidi']) }}</p>
                    <p class="text-teal-100 text-sm">Jemaat dengan dokumen sidi</p>
                </div>
                
                {{-- Belum Baptis --}}
                <div class="stat-card bg-gradient-to-br from-red-500 to-red-600 rounded-2xl p-8 shadow-xl">
                    <div class="flex items-start justify-between mb-6">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-red-100 text-sm font-semibold uppercase tracking-wider mb-2">Belum Baptis</p>
                    <p class="text-5xl font-bold text-white mb-2">{{ number_format($stats['total_jemaat'] - $stats['sudah_baptis']) }}</p>
                    <p class="text-red-100 text-sm">Perlu tindak lanjut</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Recent Activities --}}
    <section class="py-20 bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold mb-4">
                    Update Terbaru
                </span>
                <h2 class="font-heading text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Aktivitas Terkini
                </h2>
                <p class="text-xl text-gray-600">
                    Pantau perkembangan terbaru dari sistem jemaat
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8">
                {{-- Recent Members --}}
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6">
                        <h3 class="font-heading text-2xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            Anggota Terbaru
                        </h3>
                    </div>
                    <div class="p-6">
                        @if($recentMembers->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentMembers as $member)
                                <div class="flex items-center space-x-4 p-4 rounded-xl hover:bg-blue-50 transition-all group">
                                    <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform shadow-lg">
                                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-gray-900 truncate text-lg">{{ $member->anggotaKeluarga->nama ?? 'N/A' }}</p>
                                        <p class="text-sm text-gray-500 truncate">{{ $member->kelompok->nama ?? 'N/A' }}</p>
                                    </div>
                                    <span class="text-xs text-gray-400 bg-gray-100 px-3 py-1 rounded-full">{{ $member->created_at->diffForHumans() }}</span>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                </div>
                                <p class="text-gray-500">Belum ada data</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                {{-- Recent Documents --}}
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 p-6">
                        <h3 class="font-heading text-2xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Dokumen Terbaru
                        </h3>
                    </div>
                    <div class="p-6">
                        @if($recentDocs->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentDocs as $doc)
                                <div class="flex items-center space-x-4 p-4 rounded-xl hover:bg-green-50 transition-all group">
                                    <div class="w-14 h-14 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform shadow-lg">
                                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-gray-900 text-lg">{{ $doc->file_baptis ? 'Baptis' : ($doc->file_sidi ? 'Sidi' : 'Dokumen') }}</p>
                                        <p class="text-sm text-gray-500 truncate">{{ $doc->anggota->nama ?? 'N/A' }}</p>
                                    </div>
                                    <span class="text-xs text-gray-400 bg-gray-100 px-3 py-1 rounded-full">{{ $doc->created_at->diffForHumans() }}</span>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <p class="text-gray-500">Belum ada data</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gradient-to-br from-gray-900 to-gray-800 text-white py-12 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-amber-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-orange-500 rounded-full blur-3xl"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
            <div class="mb-6">
                <div class="inline-block w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="font-heading text-2xl font-bold mb-2">{{ $churchInfo->nama_gereja ?? 'Gereja' }}</h3>
            </div>
            <p class="text-gray-400 mb-2">
                &copy; {{ date('Y') }} {{ $churchInfo->nama_gereja ?? 'Gereja' }}. Semua hak dilindungi.
            </p>
            <p class="text-gray-500 text-sm">
                Sistem Informasi Jemaat - Dibangun dengan ❤️ untuk melayani
            </p>
        </div>
    </footer>
    
</body>
</html>