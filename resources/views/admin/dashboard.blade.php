@extends('layouts.aapp')

@section('sub-content') 
<div class="pt-6 px-4">
    {{-- FIRST ROW --}}
    <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ $numUsers }}</span>
                    <h3 class="text-base font-normal text-gray-500">Jumlah Akun Pembaca</h3>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ $numAdmins }}</span>
                    <h3 class="text-base font-normal text-gray-500">Jumlah Administrator</h3>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
            <div class="flex justify-betweeen items-center">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ $numBooks }}</span>
                    <h3 class="text-base font-normal text-gray-500">Jumlah Ebook</h3>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ $numCategories }}</span>
                    <h3 class="text-base font-normal text-gray-500">Jumlah Kategori</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- SECOND ROW --}}
    <div class="mt-4 w-full grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">

        {{-- GRAPH VISITORS --}}
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ $numVisitors }}</span>
                    <h3 class="text-base font-normal text-gray-500">Total Kunjungan</h3>
                </div>
            </div>
            <div id="main-chart">
                <canvas id="visitor-chart"></canvas>
            </div>
        </div>


        {{-- TOP 5 MONTHLY BOOKS --}}
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
            <!-- Card Title -->
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Popular Books</h3>
                    <span class="text-base font-normal text-gray-500">Top 5 most read books this month</span>
                </div>
            </div>
            <!-- Table -->
            <div class="flex flex-col mt-8">
                <div class="overflow-x-auto rounded-lg">
                    <div class="align-middle inline-block min-w-full">
                        <div class="shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Title
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Author
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @if(count($favoriteBooks) > 0)
                                    @foreach($favoriteBooks as $book)
                                        <tr>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm font-normal text-gray-900">
                                                {{ $book->judul }}
                                            </td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm font-normal text-gray-500">
                                                {{ $book->penulis }}
                                            </td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                {{ $book->number_of_reads }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3" class="p-4 whitespace-nowrap text-sm text-center font-normal text-gray-900">
                                                No books found
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- THIRD ROW --}}
    <div class="mt-4 w-full grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
        {{-- GRAPH CATEGORIES DISTRIBUTION --}}
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <div class="flex-shrink-0">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Ebooks Distribution</h3>
                </div>
            </div>
            <div id="main-chart">
                <canvas id="dist-chart"></canvas>
            </div>
        </div>


        {{-- TOP 5 CATEGORIES --}}
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
            <!-- Card Title -->
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Popular Categories</h3>
                    <span class="text-base font-normal text-gray-500">Top 5 most read categories this month</span>
                </div>
            </div>
            <!-- Table -->
            <div class="flex flex-col mt-8">
                <div class="overflow-x-auto rounded-lg">
                    <div class="align-middle inline-block min-w-full">
                        <div class="shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Title
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @if(count($favoriteCategories) > 0)
                                    @foreach($favoriteCategories as $category)
                                        <tr>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm font-normal text-gray-900">
                                                {{ $category->name }}
                                            </td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                {{ $category->read_count }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="2" class="p-4 whitespace-nowrap text-sm text-center font-normal text-gray-900">
                                                No categories found
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let visitorData = @json($visitorData);
    let ctx = document.getElementById('visitor-chart').getContext('2d');
    let chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: visitorData.map(d => d.month),
            datasets: [{
                label: 'Visitor Count',
                data: visitorData.map(d => d.count),
                backgroundColor: 'rgb(8 145 178)',
                borderWidth: 1
            }]
        },
        options: {}
    });

    let booksDist = @json($booksDist);
    var ctx2 = document.getElementById("dist-chart").getContext("2d");
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: [<?php echo '"' . implode('","', $booksDist->pluck('name')->toArray()) . '"'; ?>],
            datasets: [{
                label: 'Number of Books',
                data: [<?php echo implode(',', $booksDist->pluck('number_of_books')->toArray()); ?>],
                backgroundColor: 'rgb(8 145 178)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

</script>
@endsection