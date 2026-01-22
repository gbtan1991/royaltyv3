<?php
namespace App\Http\Controllers\rewards;

use App\Models\Rewards;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RewardController extends Controller
{
    public function index()
    {
        $rewards = Rewards::latest()->paginate(10);
        return view('rewards.index', compact('rewards'));
    }

    public function create()
    {
        return view('rewards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'points_cost' => 'required|integer|min:1',
            'stock_quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        Rewards::create($request->all());

        return redirect()->route('rewards.index')->with('success', 'Reward added to catalog!');
    }

    public function edit(Rewards $reward)
    {
        return view('rewards.edit', compact('reward'));
    }

    public function update(Request $request, Rewards $reward)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'points_cost' => 'required|integer|min:1',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        $reward->update($request->all());

        return redirect()->route('rewards.index')->with('success', 'Reward updated.');
    }

    public function destroy(Rewards $reward)
    {
        $reward->delete();
        return redirect()->route('rewards.index')->with('success', 'Reward removed.');
    }
}