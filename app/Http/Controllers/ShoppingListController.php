<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingListController extends Controller
{
    public function index()
    {
        $items = ShoppingList::where('user_id', Auth::id())->get();
        return view('shopping_list.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        ShoppingList::create([
            'user_id' => Auth::id(),
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
        ]);

        return redirect()->back()->with('success', 'Item added to the shopping list!');
    }

    public function update(Request $request, $id)
    {
        $item = ShoppingList::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        $item->update($request->only(['item_name', 'quantity']));

        return redirect()->back()->with('success', 'Item updated!');
    }

    public function destroy($id)
    {
        $item = ShoppingList::where('user_id', Auth::id())->findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Item removed from the shopping list!');
    }
}