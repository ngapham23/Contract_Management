<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Service;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::latest()->paginate(10);
        
        // Lấy danh sách dịch vụ để tránh lỗi undefined variable $services
        $services = \App\Models\Service::all();
    
        return view('contracts.index', compact('contracts', 'services'));
    }
    

    public function create(Request $request)
{
    $customers = User::where('role', 'customer')->get();
    $services = Service::all(); // Lấy tất cả dịch vụ
    $service = null;

    if ($request->has('service_id')) {
        $service = Service::find($request->service_id);
    }

    return view('contracts.create', compact('customers', 'services', 'service'));
}

    

public function store(Request $request)
{
    // Kiểm tra dữ liệu đầu vào
    $request->validate([
        'customer_id' => 'required|exists:users,id',
        'service_id' => 'required|exists:services,id',
        'start_date' => 'required|date',
        'amount' => 'required|numeric|min:0',
    ]);

    // Tạo hợp đồng mới
    $contract = Contract::create([
        'contract_number' => null, // Cho phép NULL
        'customer_id' => $request->customer_id,
        'service_id' => $request->service_id,
        'start_date' => $request->start_date,
        'amount' => $request->amount,
        'status' => 'pending'
    ]);
    

    // Kiểm tra xem hợp đồng có được lưu hay không
    if ($contract) {
        return redirect()->route('contracts.index')->with('success', 'Hợp đồng đã được tạo thành công.');
    } else {
        return back()->with('error', 'Lỗi khi tạo hợp đồng.');
    }
}

    public function show(Contract $contract)
    {
        return view('contracts.show', compact('contract'));
    }

    public function edit(Contract $contract)
    {
        $customers = User::where('role', 'customer')->get();
        return view('contracts.edit', compact('contract', 'customers'));
    }

    public function update(Request $request, Contract $contract)
    {
        $request->validate([
            'title' => 'required',
            'start_date' => 'required|date',
            'amount' => 'required|numeric',
            'customer_id' => 'required|exists:users,id',
        ]);

        $contract->update($request->all());
        return redirect()->route('contracts.index')->with('success', 'Hợp đồng đã được cập nhật.');
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();
        return redirect()->route('contracts.index')->with('success', 'Hợp đồng đã được xóa.');
    }
}
