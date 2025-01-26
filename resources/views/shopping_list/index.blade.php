<!DOCTYPE html>
<html>
<head>
    <title>Shopping List</title>
</head>
<body>
    <h1>Your Shopping List</h1>

    <!-- Display Success Messages -->
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <!-- Add Item Form -->
    <form action="{{ route('shopping-list.store') }}" method="POST">
        @csrf
        <input type="text" name="item_name" placeholder="Item name" required>
        <input type="number" name="quantity" placeholder="Quantity" required>
        <button type="submit">Add Item</button>
    </form>

    <!-- Display Shopping List -->
    <ul>
        @foreach ($items as $item)
            <li>
                {{ $item->item_name }} ({{ $item->quantity }})
                <form action="{{ route('shopping-list.update', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <input type="text" name="item_name" value="{{ $item->item_name }}" required>
                    <input type="number" name="quantity" value="{{ $item->quantity }}" required>
                    <button type="submit">Update</button>
                </form>
                <form action="{{ route('shopping-list.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Remove</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
