<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function getAllCustomers() {
        $customerData = Customer::all();

        //dd($customerData);
        return $customerData;
    
    }

    public function showAllCustomers () {
        $customerData = $this->getAllCustomers();

        return view('home', compact('customerData'));
    }

    // === ADDED: Create ===
    public function store(Request $request)
    {
        // Keep your current input names (custName, custAdd)
        $validated = $request->validate([
            'custName' => ['required','string','max:255'],
            'custAdd'  => ['required','string','max:255'],
        ]);

        Customer::create([
            'cust_name'    => $validated['custName'],
            'cust_address' => $validated['custAdd'],
        ]);

        return redirect('/home')->with('ok', 'Customer added!');
    }

    // === ADDED: Show edit form (reuses the same view) ===
    public function edit(Customer $customer)
    {
        $customerData    = $this->getAllCustomers();
        $editingCustomer = $customer;
        return view('home', compact('customerData', 'editingCustomer'));
    }

    // === ADDED: Update ===
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'custName' => ['required','string','max:255'],
            'custAdd'  => ['required','string','max:255'],
        ]);

        $customer->update([
            'cust_name'    => $validated['custName'],
            'cust_address' => $validated['custAdd'],
        ]);

        return redirect('/home')->with('ok', 'Customer updated!');
    }

    // === ADDED: Delete ===
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect('/home')->with('ok', 'Customer deleted.');
    }
}
