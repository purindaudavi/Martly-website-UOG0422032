@extends('admin.layout')

@section('page_title', 'Deal Management')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Deal Management</h2>
        </div>
        
        <div class="overflow-x-auto">
            @if ($deals->isEmpty())
                <div class="text-center py-10">
                    <p class="text-gray-600 text-lg">No deals are currently active.</p>
                </div>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Product Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Vendor
                            </th>
                            {{-- UPDATED: Added new columns for pricing --}}
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Original Price
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Discounted Price
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($deals as $deal)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $deal->image) }}" alt="{{ $deal->name }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $deal->name }}</div>
                                            <div class="text-sm text-gray-500 line-clamp-1">{{ $deal->description }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $deal->vendor->name ?? 'N/A' }}
                                    </span>
                                </td>
                                {{-- UPDATED: Display original and discounted prices --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    ${{ number_format($deal->price, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if ($deal->discount_percentage)
                                        <div class="text-green-600 font-bold">
                                            ${{ number_format($deal->price - ($deal->price * $deal->discount_percentage / 100), 2) }}
                                            <span class="text-xs text-red-500">({{ $deal->discount_percentage }}% off)</span>
                                        </div>
                                    @else
                                        <span class="text-gray-400">N/A</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form action="{{ route('admin.deals.toggle', $deal) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            Remove from Deals
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection