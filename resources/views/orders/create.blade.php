<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Place an Order</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10 min-h-screen">

    {{-- ===== Order form card ===== --}}
    <div class="max-w-lg mx-auto bg-white rounded-lg shadow p-8">

        <h1 class="text-2xl font-bold mb-6 text-gray-800">Place a New Order</h1>

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Success message --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        {{-- Order form --}}
        <form action="{{ route('orders.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block font-semibold mb-1">Customer Name</label>
                <input type="text"
                       name="customer_name"
                       value="{{ old('customer_name') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-semibold mb-1">Product Name</label>
                <input type="text"
                       name="product_name"
                       value="{{ old('product_name') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-semibold mb-1">Quantity</label>
                <input type="number"
                       name="quantity"
                       value="{{ old('quantity', 1) }}"
                       min="1"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-semibold mb-1">Price</label>
                <input type="number"
                       step="0.01"
                       name="price"
                       value="{{ old('price') }}"
                       min="0"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded transition">
                Place Order
            </button>

        </form>
    </div>

    {{-- ===== Orders table card ===== --}}
    <div class="max-w-3xl mx-auto mt-10 bg-white rounded-lg shadow p-8">

        <h2 class="text-xl font-bold mb-4 text-gray-800">
            Recent Orders
            <span class="text-sm font-normal text-gray-500">
                ({{ $orders->count() }} total)
            </span>
        </h2>

        @if ($orders->isEmpty())
            <p class="text-gray-500 text-center py-6">
                No orders yet. Place your first one above 👆
            </p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 text-sm uppercase">
                            <th class="px-3 py-2 border-b">ID</th>
                            <th class="px-3 py-2 border-b">Customer</th>
                            <th class="px-3 py-2 border-b">Product</th>
                            <th class="px-3 py-2 border-b text-center">Qty</th>
                            <th class="px-3 py-2 border-b text-right">Price</th>
                            <th class="px-3 py-2 border-b text-right">Placed At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-3 py-2 text-gray-500">#{{ $order->id }}</td>
                                <td class="px-3 py-2 font-medium text-gray-800">
                                    {{ $order->customer_name }}
                                </td>
                                <td class="px-3 py-2 text-gray-700">
                                    {{ $order->product_name }}
                                </td>
                                <td class="px-3 py-2 text-center text-gray-700">
                                    {{ $order->quantity }}
                                </td>
                                <td class="px-3 py-2 text-right text-gray-700">
                                    ${{ number_format($order->price, 2) }}
                                </td>
                                <td class="px-3 py-2 text-right text-gray-500 text-sm">
                                    {{ $order->created_at->format('M d, Y H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</body>
</html>