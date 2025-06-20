<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SupplierRequest;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::query()->withCount('products');
        
        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('supplier_name', 'like', "%$search%")
                  ->orWhere('contact_person', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
            });
        }
        
        // Filter by status
        if ($request->has('status') && in_array($request->status, ['active', 'inactive'])) {
            $query->where('is_active', $request->status === 'active');
        }
        
        $suppliers = $query->latest()->paginate(15);
        
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        $countries = Supplier::countries();
        return view('suppliers.create', compact('countries'));
    }

    public function store(SupplierRequest $request)
    {
        DB::beginTransaction();
        
        try {
            $supplier = Supplier::create($request->validated());
            
            DB::commit();
            
            return redirect()
                ->route('suppliers.show', $supplier->id)
                ->with('success', 'Supplier created successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Error creating supplier: ' . $e->getMessage());
        }
    }

    public function show(Supplier $supplier)
    {
        $supplier->load(['products', 'purchases']);
        return view('suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        $countries = Supplier::countries();
        return view('suppliers.edit', compact('supplier', 'countries'));
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {
        DB::beginTransaction();
        
        try {
            $supplier->update($request->validated());
            
            DB::commit();
            
            return redirect()
                ->route('suppliers.show', $supplier->id)
                ->with('success', 'Supplier updated successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Error updating supplier: ' . $e->getMessage());
        }
    }

    public function destroy(Supplier $supplier)
    {
        DB::beginTransaction();
        
        try {
            // Check if supplier has associated products or purchases
            if ($supplier->products()->exists()) {
                return back()
                    ->with('error', 'Cannot delete supplier with associated products. Deactivate instead.');
            }
            
            $supplier->delete();
            
            DB::commit();
            
            return redirect()
                ->route('suppliers.index')
                ->with('success', 'Supplier deleted successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->with('error', 'Error deleting supplier: ' . $e->getMessage());
        }
    }
    
    public function toggleStatus(Supplier $supplier)
    {
        $supplier->update(['is_active' => !$supplier->is_active]);
        
        $status = $supplier->is_active ? 'activated' : 'deactivated';
        
        return back()
            ->with('success', "Supplier $status successfully!");
    }
}