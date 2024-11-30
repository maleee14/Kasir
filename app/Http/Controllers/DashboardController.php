<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Member;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $kategori = Category::count();
        $produk = Product::count();
        $member = Member::count();
        $supplier = Supplier::count();

        return view('dashboard', compact('kategori', 'produk', 'member', 'supplier'));
    }
}
