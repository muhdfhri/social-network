<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filkom UNUSU - Social Network</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .feature-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        
        .feature-card:hover::before {
            opacity: 1;
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.2);
        }
        
        .stat-card {
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: scale(1.05);
        }
        
        .blob {
            animation: blob 7s infinite;
        }
        
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }
        
        .scroll-indicator {
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(10px); }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="fixed w-full glass-card z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-purple-600 to-indigo-600 flex items-center justify-center">
                        <span class="text-white font-bold text-xl">F</span>
                    </div>
                    <span class="text-xl font-bold text-gray-900">Filkom UNUSU</span>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-gray-700 hover:text-purple-600 font-medium transition">Fitur</a>
                    <a href="#about" class="text-gray-700 hover:text-purple-600 font-medium transition">Tentang</a>
                    <a href="{{ route('login') }}" class="btn-primary text-white px-6 py-2 rounded-full font-medium">
                        Masuk
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <a href="{{ route('login') }}" class="btn-primary text-white px-4 py-2 rounded-full font-medium text-sm mr-3">
                        Masuk
                    </a>
                    <button type="button" class="text-gray-700 hover:text-purple-600 focus:outline-none" id="mobile-menu-button">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white rounded-lg mt-2 shadow-lg">
                    <a href="#features" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-purple-600 hover:bg-gray-50">Fitur</a>
                    <a href="#about" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-purple-600 hover:bg-gray-50">Tentang</a>
                </div>
            </div>
        </div>
    </nav>
    
    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            
            // Toggle between menu and close icon
            const menuIcon = mobileMenuButton.querySelector('svg');
            if (mobileMenu.classList.contains('hidden')) {
                menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />';
            } else {
                menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
            }
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!mobileMenuButton.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.add('hidden');
                const menuIcon = mobileMenuButton.querySelector('svg');
                menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />';
            }
        });
    </script>

    <!-- Hero Section -->
    <section class="relative pt-24 pb-16 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <div class="absolute inset-0 hero-gradient opacity-5"></div>
        <div class="absolute top-20 left-10 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 blob"></div>
        <div class="absolute top-40 right-10 w-72 h-72 bg-indigo-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 blob" style="animation-delay: 2s;"></div>
        
        <div class="max-w-7xl mx-auto relative">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="fade-in">
                    <div class="inline-block mb-4">
                        <span class="bg-purple-100 text-purple-700 px-4 py-2 rounded-full text-sm font-semibold">
                            🎓 Platform Mahasiswa #1
                        </span>
                    </div>
                    <h1 class="text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
                        Connect, Share,
                        <span class="gradient-text block">Grow Together</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Platform jejaring sosial eksklusif untuk mahasiswa Fakultas Ilmu Komputer UNUSU. Yuk, gabung dan jadi bagian dari komunitas yang seru! ✨
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#" class="btn-primary text-white px-8 py-4 rounded-full font-semibold text-center inline-flex items-center justify-center">
                            Mulai Sekarang
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                        <a href="#features" class="bg-white text-gray-900 px-8 py-4 rounded-full font-semibold text-center border-2 border-gray-200 hover:border-purple-600 transition">
                            Lihat Fitur
                        </a>
                    </div>
                    <div class="mt-8 flex items-center gap-6">
                        <div class="flex -space-x-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 to-pink-400 border-2 border-white"></div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-indigo-400 border-2 border-white"></div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-400 to-teal-400 border-2 border-white"></div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-400 to-red-400 border-2 border-white"></div>
                        </div>
                        <div>
                            <p class="text-gray-900 font-semibold">500+ Mahasiswa</p>
                            <p class="text-gray-600 text-sm">sudah bergabung</p>
                        </div>
                    </div>
                </div>
                <div class="relative floating">
                    <div class="relative z-10">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Students" class="rounded-3xl shadow-2xl">
                        <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-2xl shadow-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">1,234</p>
                                    <p class="text-sm text-gray-600">Diskusi Aktif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-16 scroll-indicator">
                <svg class="w-6 h-6 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-purple-600 font-semibold text-sm uppercase tracking-wider">Fitur Unggulan</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-3 mb-4">Kenapa Harus Gabung?</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Platform yang dirancang khusus untuk kebutuhan mahasiswa modern</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg feature-card">
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-indigo-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Networking Seru</h3>
                    <p class="text-gray-600 leading-relaxed">Kenalan sama temen-temen satu fakultas, sharing pengalaman, dan build koneksi yang bermanfaat.</p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-lg feature-card">
                    <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-rose-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Diskusi Real-time</h3>
                    <p class="text-gray-600 leading-relaxed">Obrolin tugas, project, atau apa aja bareng komunitas yang supportif dan asik.</p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-lg feature-card">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Update Terbaru</h3>
                    <p class="text-gray-600 leading-relaxed">Dapetin info terkini tentang kampus, event, dan kesempatan yang nggak boleh dilewatin.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-purple-600 to-indigo-600">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-8 text-center">
                <div class="stat-card">
                    <div class="text-5xl font-bold text-white mb-2">500+</div>
                    <div class="text-purple-200">Mahasiswa Aktif</div>
                </div>
                <div class="stat-card">
                    <div class="text-5xl font-bold text-white mb-2">1K+</div>
                    <div class="text-purple-200">Diskusi/Bulan</div>
                </div>
                <div class="stat-card">
                    <div class="text-5xl font-bold text-white mb-2">100%</div>
                    <div class="text-purple-200">Free</div>
                </div>
                <div class="stat-card">
                    <div class="text-5xl font-bold text-white mb-2">24/7</div>
                    <div class="text-purple-200">Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="text-purple-600 font-semibold text-sm uppercase tracking-wider">Tentang Kami</span>
                    <h2 class="text-4xl font-bold text-gray-900 mt-3 mb-6">Platform by Students, for Students</h2>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        Filkom UNUSU dibuat khusus untuk mahasiswa Fakultas Ilmu Komputer UNUSU yang pengen punya tempat berkumpul digital yang nyaman dan produktif.
                    </p>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Di sini, lo bisa ngobrol, sharing ilmu, cari temen project, sampe dapet info terbaru seputar kampus. All in one place! 🚀
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-purple-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-900">Komunitas Supportif</h4>
                                <p class="text-gray-600">Tempat yang aman buat nanya dan belajar bareng</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-purple-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-900">Eksklusif untuk Mahasiswa</h4>
                                <p class="text-gray-600">Hanya untuk civitas akademika Filkom UNUSU</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-purple-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-900">Selalu Update</h4>
                                <p class="text-gray-600">Fitur baru terus ditambah sesuai kebutuhan</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=500&q=80" class="rounded-2xl shadow-lg" alt="Students">
                    <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?auto=format&fit=crop&w=500&q=80" class="rounded-2xl shadow-lg mt-8" alt="Learning">
                    <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=500&q=80" class="rounded-2xl shadow-lg -mt-8" alt="Discussion">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=500&q=80" class="rounded-2xl shadow-lg" alt="Teamwork">
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-gradient-to-br from-purple-600 to-indigo-600 rounded-3xl p-12 text-center shadow-2xl">
                <h2 class="text-4xl font-bold text-white mb-4">Yuk, Gabung Sekarang!</h2>
                <p class="text-xl text-purple-100 mb-8 max-w-2xl mx-auto">
                    Jadi bagian dari komunitas mahasiswa Filkom UNUSU yang seru dan produktif. Gratis, kok! 🎉
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('register') }}" class="bg-white text-purple-600 px-8 py-4 rounded-full font-semibold hover:bg-gray-100 transition">
                        Daftar Gratis
                    </a>
                    <a href="{{ route('terms-and-conditions') }}" class="bg-purple-700 text-white px-8 py-4 rounded-full font-semibold hover:bg-purple-800 transition">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-purple-600 to-indigo-600 flex items-center justify-center">
                            <span class="text-white font-bold text-xl">F</span>
                        </div>
                        <span class="text-xl font-bold">Filkom UNUSU</span>
                    </div>
                    <p class="text-gray-400 leading-relaxed">Platform jejaring sosial untuk mahasiswa Fakultas Ilmu Komputer UNUSU.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-lg mb-4">Menu</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">Beranda</a></li>
                        <li><a href="#features" class="text-gray-400 hover:text-white transition">Fitur</a></li>
                        <li><a href="#about" class="text-gray-400 hover:text-white transition">Tentang</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-lg mb-4">Kontak</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li>info@filkom-unusu.ac.id</li>
                        <li>+62 123 4567 890</li>
                        <li>Medan, Sumatera Utara</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-lg mb-4">Follow Us</h4>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} Filkom UNUSU. Made with 💜 by students</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar background on scroll
        const navbar = document.querySelector('nav');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                navbar.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.7)';
                navbar.style.boxShadow = 'none';
            }
        });

        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements
        document.querySelectorAll('.feature-card, .stat-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s ease';
            observer.observe(el);
        });
    </script>
</body>
</html>