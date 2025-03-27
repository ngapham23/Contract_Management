<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // Kiểm tra quyền 'create' với ServicePolicy
    $this->authorize('create', Service::class);
    return view('services.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Service::class);
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
        ]);

        Service::create($data);
        return redirect()->route('services.index', ['status' => 'created']);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::findOrFail($id);
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    $service = Service::findOrFail($id); // Lấy dịch vụ trước
    $this->authorize('update', $service); // Truyền instance $service

    return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    $service = Service::findOrFail($id); // Lấy dịch vụ trước
    $this->authorize('update', $service); // Truyền instance $service

    $data = $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'price'       => 'required|numeric',
    ]);

    $service->update($data);
    return redirect()->route('services.index', ['status' => 'updated']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $service = Service::findOrFail($id); // Lấy dịch vụ trước
    $this->authorize('delete', $service); // Truyền instance $service

    $service->delete();
    return redirect()->route('services.index', ['status' => 'deleted']);
}

}
