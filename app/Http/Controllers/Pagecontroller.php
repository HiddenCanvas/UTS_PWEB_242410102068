<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Helper: default products (dipakai kalau session kosong)
    private function defaultProducts()
    {
        return [
            ['id'=>1, 'name'=>'DeathFizz Cola 500ml', 'price'=>12000, 'stock'=>10, 'category'=>'Classic', 'image'=>'images/soda1.jpg'],
            ['id'=>2, 'name'=>'Tropical Fizz 330ml', 'price'=>14000, 'stock'=>8, 'category'=>'Tropical', 'image'=>'images/soda2.jpg'],
            ['id'=>3, 'name'=>'Desert Burst 330ml', 'price'=>13000, 'stock'=>5, 'category'=>'Desert', 'image'=>'images/soda3.jpg'],
            ['id'=>4, 'name'=>'Winter Chill 500ml', 'price'=>15000, 'stock'=>3, 'category'=>'Winter', 'image'=>'images/soda4.jpg'],
        ];
    }

    // Helper: get activity feed from session
    private function getActivityFeed()
    {
        return session('activity_feed', []);
    }

    // Helper: add activity to feed
    private function addActivity($type, $message)
    {
        $activities = $this->getActivityFeed();
        
        $newActivity = [
            'type' => $type, // 'add', 'edit', 'delete', 'login'
            'message' => $message,
            'timestamp' => now()->format('Y-m-d H:i:s')
        ];
        
        array_unshift($activities, $newActivity); // Add to beginning
        
        // Keep only last 10 activities
        $activities = array_slice($activities, 0, 10);
        
        session(['activity_feed' => $activities]);
    }

    // LOGIN - menampilkan form (GET) atau meng-handle form (POST)
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'username' => 'required|string|max:50',
                'password' => 'required|string',
            ]);

            $username = $request->input('username');
            
            // Add login activity
            $this->addActivity('login', "User $username logged in");

            // redirect ke dashboard sambil membawa query param username
            return redirect()->route('dashboard', ['username' => $username]);
        }

        return view('login');
    }

    // DASHBOARD - halaman utama dengan analytics
    public function dashboard(Request $request)
    {
        // Ambil username dari query parameter (jika ada)
        $username = $request->query('username', null);

        // Produk diambil dari session (jika ada) atau default list
        $products = session('products', $this->defaultProducts());

        // Statistik sederhana
        $totalProducts = count($products);
        $totalStock = array_sum(array_column($products, 'stock'));
        $lowStockCount = collect($products)->filter(function($p){ return $p['stock'] <= 5; })->count();
        
        // Total value calculation
        $totalValue = collect($products)->sum(function($p) {
            return $p['price'] * $p['stock'];
        });
        
        // Average price
        $avgPrice = $totalProducts > 0 ? collect($products)->avg('price') : 0;
        
        // Category distribution for analytics
        $categoryStats = collect($products)->groupBy('category')->map(function($group) {
            return [
                'count' => count($group),
                'total_stock' => array_sum(array_column($group->toArray(), 'stock')),
                'total_value' => collect($group)->sum(function($p) {
                    return $p['price'] * $p['stock'];
                })
            ];
        });
        
        // Activity feed
        $activityFeed = $this->getActivityFeed();

        // Kirim data ke view
        return view('dashboard', compact(
            'username',
            'products',
            'totalProducts',
            'totalStock',
            'lowStockCount',
            'totalValue',
            'avgPrice',
            'categoryStats',
            'activityFeed'
        ));
    }

    // PENGELOLAAN - tampilkan daftar produk dengan filter dan search
    public function pengelolaan(Request $request)
    {
        $products = session('products', $this->defaultProducts());
        
        // Search functionality
        $search = $request->query('search', '');
        if ($search) {
            $products = array_filter($products, function($p) use ($search) {
                return stripos($p['name'], $search) !== false || 
                       stripos($p['category'], $search) !== false;
            });
        }
        
        // Filter by category
        $filterCategory = $request->query('category', '');
        if ($filterCategory) {
            $products = array_filter($products, function($p) use ($filterCategory) {
                return $p['category'] === $filterCategory;
            });
        }
        
        // Filter by stock status
        $filterStock = $request->query('stock_status', '');
        if ($filterStock === 'low') {
            $products = array_filter($products, function($p) {
                return $p['stock'] <= 5;
            });
        } elseif ($filterStock === 'available') {
            $products = array_filter($products, function($p) {
                return $p['stock'] > 5;
            });
        }
        
        // Sort functionality
        $sortBy = $request->query('sort_by', 'id');
        $sortOrder = $request->query('sort_order', 'asc');
        
        $products = collect($products)->sortBy($sortBy, SORT_REGULAR, $sortOrder === 'desc')->values()->toArray();
        
        // Get unique categories for filter dropdown
        $allProducts = session('products', $this->defaultProducts());
        $categories = collect($allProducts)->pluck('category')->unique()->sort()->values()->toArray();
        
        return view('pengelolaan', compact('products', 'categories', 'search', 'filterCategory', 'filterStock', 'sortBy', 'sortOrder'));
    }

    // Form create product
    public function create()
    {
        return view('pengelolaan_create');
    }

    // Simpan product ke session (store)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'nullable|string|max:50',
        ]);

        $products = session('products', $this->defaultProducts());

        $ids = array_column($products, 'id');
        $nextId = $ids ? max($ids) + 1 : 1;

        $new = [
            'id' => $nextId,
            'name' => $request->input('name'),
            'price' => (int)$request->input('price'),
            'stock' => (int)$request->input('stock'),
            'category' => $request->input('category', 'Classic'),
            'image' => 'images/placeholder.png',
        ];

        $products[] = $new;
        session(['products' => $products]);
        
        // Add activity
        $this->addActivity('add', "Added product: {$new['name']}");

        return redirect()->route('pengelolaan')->with('success', 'Produk berhasil ditambahkan.');
    }

    // Edit form
    public function edit($id)
    {
        $products = session('products', $this->defaultProducts());
        $product = collect($products)->firstWhere('id', (int)$id);

        if (!$product) return redirect()->route('pengelolaan')->with('error', 'Produk tidak ditemukan.');

        return view('pengelolaan_edit', compact('product'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'nullable|string|max:50',
        ]);

        $products = session('products', $this->defaultProducts());
        $productName = '';

        foreach ($products as &$p) {
            if ($p['id'] == (int)$id) {
                $productName = $p['name'];
                $p['name'] = $request->input('name');
                $p['price'] = (int)$request->input('price');
                $p['stock'] = (int)$request->input('stock');
                $p['category'] = $request->input('category', $p['category']);
                break;
            }
        }

        session(['products' => $products]);
        
        // Add activity
        $this->addActivity('edit', "Updated product: $productName");
        
        return redirect()->route('pengelolaan')->with('success', 'Produk berhasil diupdate.');
    }

    // Delete product
    public function destroy($id)
    {
        $products = session('products', $this->defaultProducts());
        
        // Find product name before deletion
        $deletedProduct = collect($products)->firstWhere('id', (int)$id);
        $productName = $deletedProduct ? $deletedProduct['name'] : 'Unknown';
        
        $products = array_filter($products, function($p) use ($id) {
            return $p['id'] != (int)$id;
        });
        
        // reindex array
        $products = array_values($products);
        session(['products' => $products]);
        
        // Add activity
        $this->addActivity('delete', "Deleted product: $productName");

        return redirect()->route('pengelolaan')->with('success', 'Produk berhasil dihapus.');
    }

    // PROFILE - tampilkan username dan statistik
    public function profile(Request $request)
    {
        $username = $request->query('username', null);
        $products = session('products', $this->defaultProducts());
        $totalProducts = count($products);

        return view('profile', compact('username','totalProducts'));
    }
}