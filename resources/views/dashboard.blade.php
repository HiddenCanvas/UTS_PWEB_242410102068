@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    main {
        padding: 0 !important;
    }
    .username-badge {
position: fixed; /* tetap di tempat tanpa ganggu hero */
top: 80px; /* pas di bawah navbar */
left: 2rem;
background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
border: 1px solid #4ade80;
color: #4ade80;
padding: 0.75rem 1.25rem;
border-radius: 1rem;
font-weight: 600;
box-shadow: 0 4px 25px rgba(74, 222, 128, 0.25);
z-index: 2000; /* pastikan di atas semua elemen hero */
display: flex;
align-items: center;
gap: 0.6rem;
backdrop-filter: blur(10px);
transition: all 0.3s ease;
}


.username-badge:hover {
background: linear-gradient(135deg, #2f2f2f 0%, #3f3f3f 100%);
transform: translateY(-2px);
}


.username-badge .icon {
font-size: 1.25rem;
color: #22c55e;
}

    /* Banner Section */
    .banner {
        height: 100vh;
        width: 100%;
        overflow: hidden;
        position: relative;
        background: url('images/background.jpg') center/cover no-repeat;
    }

    .banner .product {
        width: 500px;
        height: 500px;
        position: absolute;
        bottom: 170px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1;
        transition: 0.7s;
        display: flex;
        --left: 0px;
    }

    .banner .product .soda {
        background: var(--url) var(--left) 0, url(images/mockup.png) center / auto 100% no-repeat;
        width: 280px;
        aspect-ratio: 2 / 4;
        background-blend-mode: multiply;
        mask-image: url(images/mockup.png);
        mask-size: auto 100%;
        mask-position: center;
        -webkit-mask-image: url(images/mockup.png);
        -webkit-mask-size: auto 100%;
        -webkit-mask-position: center;
        transition: 0.7s;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        top: 25%;
    }

    .banner .product:hover {
        --left: -1000px;
        transform: translateX(-50%) translateY(-120px);
    }

    .banner .rock {
        position: absolute;
        inset: 0 0 0 0;
        pointer-events: none;
    }

    .banner .rock img {
        position: absolute;
        transition: 0.7s;
    }

    .banner .rock img:nth-child(1) {
        height: 170px;
        left: 50%;
        transform: translateX(-50%);
        bottom: -30px;
    }

    .banner:has(.product:hover) .rock img:nth-child(1) {
        transform: translateX(-50%) translateY(50px);
    }

    .banner .rock img:nth-child(2) {
        height: 50%;
        left: 0;
        bottom: 0;
    }

    .banner:has(.product:hover) .rock img:nth-child(2) {
        transform: translateX(-100px) translateY(100px);
    }

    .banner .rock img:nth-child(3) {
        height: 100%;
        right: 0;
        bottom: -100px;
        rotate: -25deg;
    }

    .banner:has(.product:hover) .rock img:nth-child(3) {
        transform: translateX(100px) translateY(100px);
    }

    .welcome-text {
        position: absolute;
        top: 20%;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        text-align: center;
        color: white;
        font-size: 3rem;
        font-weight: bold;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.8);
    }

    /* Analytics Section */
    .analytics-section {
        background: #0a0a0a;
        padding: 4rem 2rem;
        min-height: 100vh;
    }

    .stat-card {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        border: 1px solid #333;
        border-radius: 1rem;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        border-color: #4ade80;
        box-shadow: 0 10px 30px rgba(74, 222, 128, 0.2);
    }

    .stat-icon {
        width: 3rem;
        height: 3rem;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .activity-item {
        background: #1a1a1a;
        border-left: 3px solid #4ade80;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 0.75rem;
        transition: all 0.3s ease;
    }

    .activity-item:hover {
        background: #252525;
        transform: translateX(5px);
    }

    .activity-icon {
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
    }

    .chart-bar {
        background: linear-gradient(to top, #4ade80, #22c55e);
        border-radius: 0.25rem;
        transition: all 0.3s ease;
    }

    .chart-bar:hover {
        background: linear-gradient(to top, #22c55e, #16a34a);
        transform: scaleY(1.05);
    }
</style>
@endpush

@section('content')
<!-- Banner Section -->
<div class="banner">
@if($username)
<div class="username-badge">
    <div class="flex flex-col leading-tight">
        <div class="flex items-center gap-2 text-lg font-semibold">
            <span class="icon text-2xl">👤</span>
            <span>Hai, <span class="text-green-400">{{ $username }}</span>!</span>
        </div>
        <p class="text-sm text-gray-300 mt-1 italic">Sudah saatnya menikmati kesegaran abadi dari <span class="text-green-400 font-medium">Elixir of Life</span> 🧃</p>
    </div>
</div>
@endif



    <div class="product">
        <div class="soda" style="--url: url('images/soda1.png');"></div>
    </div>

    <div class="rock">
        <img src="images/rock1.png" alt="rock1" />
        <img src="images/rock2.png" alt="rock2" />
        <img src="images/rock3.png" alt="rock3" />
    </div>
</div>

<!-- Analytics Section -->
<div class="analytics-section">
    <div class="container mx-auto max-w-7xl ">
        <!-- Page Title -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Dashboard Analytics</h1>
            <p class="text-gray-400">Monitor your product inventory and performance</p>
        </div>

        <!-- Stat Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Products -->
            <div class="stat-card">
                <div class="flex items-start justify-between mb-4">
                    <div class="stat-icon bg-blue-500/20 text-blue-400">
                        📦
                    </div>
                    <span class="text-xs text-gray-400">Total</span>
                </div>
                <h3 class="text-3xl font-bold text-white mb-1">{{ $totalProducts }}</h3>
                <p class="text-sm text-gray-400">Total Products</p>
            </div>

            <!-- Total Stock -->
            <div class="stat-card">
                <div class="flex items-start justify-between mb-4">
                    <div class="stat-icon bg-green-500/20 text-green-400">
                        📊
                    </div>
                    <span class="text-xs text-gray-400">Units</span>
                </div>
                <h3 class="text-3xl font-bold text-white mb-1">{{ $totalStock }}</h3>
                <p class="text-sm text-gray-400">Total Stock</p>
            </div>

            <!-- Low Stock Alert -->
            <div class="stat-card">
                <div class="flex items-start justify-between mb-4">
                    <div class="stat-icon bg-red-500/20 text-red-400">
                        ⚠️
                    </div>
                    <span class="text-xs text-gray-400">Alert</span>
                </div>
                <h3 class="text-3xl font-bold text-white mb-1">{{ $lowStockCount }}</h3>
                <p class="text-sm text-gray-400">Low Stock Items</p>
            </div>

            <!-- Total Inventory Value -->
            <div class="stat-card">
                <div class="flex items-start justify-between mb-4">
                    <div class="stat-icon bg-purple-500/20 text-purple-400">
                        💰
                    </div>
                    <span class="text-xs text-gray-400">IDR</span>
                </div>
                <h3 class="text-3xl font-bold text-white mb-1">{{ number_format($totalValue, 0, ',', '.') }}</h3>
                <p class="text-sm text-gray-400">Inventory Value</p>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Category Analytics (2 columns) -->
            <div class="lg:col-span-2">
                <div class="stat-card h-full">
                    <h2 class="text-2xl font-bold text-white mb-6">Category Analytics</h2>
                    
                    <div class="space-y-6">
                        @foreach($categoryStats as $category => $stats)
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-white font-medium">{{ $category }}</span>
                                <span class="text-gray-400 text-sm">{{ $stats['count'] }} products</span>
                            </div>
                            
                            <!-- Progress Bar for Stock -->
                            <div class="relative h-8 bg-gray-800 rounded-lg overflow-hidden mb-2">
                                <div class="chart-bar h-full" style="width: {{ ($totalStock > 0) ? ($stats['total_stock'] / $totalStock * 100) : 0 }}%"></div>
                                <span class="absolute inset-0 flex items-center justify-center text-xs font-medium text-white">
                                    {{ $stats['total_stock'] }} units
                                </span>
                            </div>
                            
                            <div class="flex justify-between text-xs text-gray-400">
                                <span>Value: Rp {{ number_format($stats['total_value'], 0, ',', '.') }}</span>
                                <span>{{ ($totalStock > 0) ? round($stats['total_stock'] / $totalStock * 100, 1) : 0 }}% of total</span>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @if(count($categoryStats) == 0)
                    <div class="text-center py-12 text-gray-400">
                        <p>No data available</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Activity Feed (1 column) -->
            <div class="lg:col-span-1">
                <div class="stat-card h-full">
                    <h2 class="text-2xl font-bold text-white mb-6">Recent Activity</h2>
                    
                    <div class="space-y-3 max-h-96 overflow-y-auto pr-2">
                        @forelse($activityFeed as $activity)
                        <div class="activity-item">
                            <div class="flex items-start gap-3">
                                <div class="activity-icon {{ 
                                    $activity['type'] == 'add' ? 'bg-green-500/20 text-green-400' : 
                                    ($activity['type'] == 'edit' ? 'bg-blue-500/20 text-blue-400' : 
                                    ($activity['type'] == 'delete' ? 'bg-red-500/20 text-red-400' : 
                                    'bg-purple-500/20 text-purple-400')) 
                                }}">
                                    {{ 
                                        $activity['type'] == 'add' ? '➕' : 
                                        ($activity['type'] == 'edit' ? '✏️' : 
                                        ($activity['type'] == 'delete' ? '🗑️' : '👤'))
                                    }}
                                </div>
                                <div class="flex-1">
                                    <p class="text-white text-sm">{{ $activity['message'] }}</p>
                                    <p class="text-gray-400 text-xs mt-1">{{ $activity['timestamp'] }}</p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8 text-gray-400">
                            <p class="text-sm">No recent activity</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats Summary -->
        <div class="mt-8 stat-card">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Average Price</p>
                    <p class="text-2xl font-bold text-white">Rp {{ number_format($avgPrice, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm mb-1">Categories</p>
                    <p class="text-2xl font-bold text-white">{{ count($categoryStats) }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm mb-1">Stock Health</p>
                    <p class="text-2xl font-bold {{ $lowStockCount > 0 ? 'text-red-400' : 'text-green-400' }}">
                        {{ $lowStockCount > 0 ? 'Needs Attention' : 'Good' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection