<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\MasterAccount;
use App\Models\SlaveAccount;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    protected function checkPlan()
    {
        $customer = Auth::guard('customer')->user();
        return Order::where('customer_id', $customer->id)
            ->whereIn('status', ['active', 'completed'])
            ->exists();
    }

    public function storeMaster(Request $request)
    {
        if (!$this->checkPlan()) {
            return back()->with('error', 'You must purchase a plan to create a master account.');
        }

        $customer = Auth::guard('customer')->user();
        
        if ($customer->masterAccount) {
            return back()->with('error', 'You can only have one master account.');
        }

        $request->validate([
            'trading_id' => 'required|string',
            'server' => 'required|string',
            'password' => 'required|string',
        ]);

        $customer->masterAccount()->create([
            'trading_id' => $request->input('trading_id'),
            'server' => $request->input('server'),
            'password' => $request->password, // In a real app, this should be encrypted if needed or handled securely
        ]);

        return back()->with('success', 'Master account created successfully.');
    }

    public function updateMaster(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $master = $customer->masterAccount;

        if (!$master) {
            return back()->with('error', 'Master account not found.');
        }

        $request->validate([
            'trading_id' => 'required|string',
            'server' => 'required|string',
            'password' => 'required|string',
        ]);

        $master->update([
            'trading_id' => $request->input('trading_id'),
            'server' => $request->input('server'),
            'password' => $request->password,
        ]);

        return back()->with('success', 'Master account updated successfully.');
    }

    public function storeSlave(Request $request)
    {
        if (!$this->checkPlan()) {
            return back()->with('error', 'You must purchase a plan to add slave accounts.');
        }

        $customer = Auth::guard('customer')->user();
        $master = $customer->masterAccount;

        if (!$master) {
            return back()->with('error', 'Please create a master account first.');
        }

        if ($master->slaveAccounts()->count() >= 10) {
            return back()->with('error', 'You can only have a maximum of 10 slave accounts.');
        }

        $request->validate([
            'trading_id' => 'required|string',
            'server' => 'required|string',
            'password' => 'required|string',
        ]);

        $master->slaveAccounts()->create([
            'trading_id' => $request->input('trading_id'),
            'server' => $request->input('server'),
            'password' => $request->password,
        ]);

        return back()->with('success', 'Slave account added successfully.');
    }

    public function updateSlave(Request $request, SlaveAccount $slave)
    {
        $customer = Auth::guard('customer')->user();
        
        // Ensure slave belongs to user's master account
        if ($slave->master_account_id !== $customer->masterAccount->id) {
            abort(403);
        }

        $request->validate([
            'trading_id' => 'required|string',
            'server' => 'required|string',
            'password' => 'required|string',
        ]);

        $slave->update([
            'trading_id' => $request->input('trading_id'),
            'server' => $request->input('server'),
            'password' => $request->password,
        ]);

        return back()->with('success', 'Slave account updated successfully.');
    }
}
