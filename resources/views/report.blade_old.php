@extends('layouts.dashboard')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Report')
@section('content')

<main class="h-full overflow-y-auto" x-data="report('{{ csrf_token() }}')">
    <div class="container px-6 mx-auto grid" x-data="paginator()">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Report
        </h2>



        <form @submit.prevent="getData()" class="flex flex-col flex-wrap mb-4 space-y-4 md:flex-row md:items-end md:space-x-4">

            <!-- Group By Selector -->
            <ul class="flex flex-col sm:flex-row">
                <li class="inline-flex items-center gap-x-2.5 py-2.5 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    <span class="w-full text-gray-600 dark:text-gray-400 py-auto font-semibold uppercase">Group By</span>
                </li>

                <li class="inline-flex items-center gap-x-2.5 py-2.5 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    <div class="relative flex items-start w-full">
                        <div class="flex items-center h-5">
                            <input x-model="group" value="apps" id="hs-horizontal-list-group-item-radio-1" name="hs-horizontal-list-group-item-radio" type="radio" class="border-gray-200 rounded-full dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" checked>
                        </div>
                        <label for="hs-horizontal-list-group-item-radio-1" class="ml-3 block w-full text-sm text-gray-600 dark:text-gray-400">
                            Apps
                        </label>
                    </div>
                </li>

                <li class="inline-flex items-center gap-x-2.5 py-2.5 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    <div class="relative flex items-start w-full">
                        <div class="flex items-center h-5">
                            <input x-model="group" value="adunits" id="hs-horizontal-list-group-item-radio-2" name="hs-horizontal-list-group-item-radio" type="radio" class="border-gray-200 rounded-full dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                        </div>
                        <label for="hs-horizontal-list-group-item-radio-2" class="ml-3 block w-full text-sm text-gray-600 dark:text-gray-400">
                            Ad units
                        </label>
                    </div>
                </li>

                <li class="inline-flex items-center gap-x-2.5 py-2.5 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    <div class="relative flex items-start w-full">
                        <div class="flex items-center h-5">
                            <input x-model="group" value="days" id="hs-horizontal-list-group-item-radio-3" name="hs-horizontal-list-group-item-radio" type="radio" class="border-gray-200 rounded-full dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                        </div>
                        <label for="hs-horizontal-list-group-item-radio-3" class="ml-3 block w-full text-sm text-gray-600 dark:text-gray-400">
                            Days
                        </label>
                    </div>
                </li>
            </ul>




            <!-- Date Range Picker -->
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>

                <input id="dateRange" readonly class="w-full rounded-md border border-gray-200 py-2 pl-12 pr-3 text-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">

            </div>


            <!-- Update button. -->
            <div class="justify-end">

                <button type="submit" class="px-6 py-2.5 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Update
                </button>
            </div>

        </form>


        <!-- New Table -->
        <div x-show="!loading" x-init="getData()" class="w-full border border-gray-200 dark:border-gray-700 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <template x-for="column in columns">
                                <th class="px-4 py-3" x-text="column"></th>
                            </template>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                        <template x-for="row in listed_data">
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td x-text="row.name" class="px-4 py-3 text-sm font-semibold"></td>
                                <td class="px-4 py-3 text-sm" x-text="row.impressions"></td>
                                <td class="px-4 py-3 text-xs">

                                    <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100" x-text="row.clicks"></span>

                                </td>
                                <td class="px-4 py-3 text-sm" x-text="row.ctr"></td>
                                <td class="px-4 py-3 text-sm" x-text="row.revenue"></td>

                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3" x-text="`Showing ${first_item+1}-${last_item} of ${all_data.length}`">

                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                    <nav aria-label="Table navigation">
                        <ul class="inline-flex items-center">

                            <li>

                                <div class="relative inline-flex self-center">
                                    <span class="flex items-center mr-2">Show</span>
                                    <select x-model.number="pager" x-init="$watch('pager', value => reset_paginator())" class="text-xs rounded border border-gray-200 dark:border-gray-500 text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-700 hover:border-gray-400 focus:outline-none appearance-none">
                                        <option value="1">1</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="500">500</option>
                                    </select>
                                </div>

                            </li>


                            <li>
                                <button :disabled="!pre_btn" @click="prev()" class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
                                    <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </li>

                            <li>
                                <button :disabled="!nex_btn" @click="next()" class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next">
                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </li>
                        </ul>
                    </nav>
                </span>
            </div>
        </div>

        <!-- Loading Transition -->
        <div x-show="loading" class="w-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 overflow-hidden rounded-lg shadow-xs p-4 mx-auto">
            <div class="animate-pulse flex space-x-4">

                <div class="flex-1 space-y-6 py-1">
                    <div class="h-2 rounded bg-gray-500 dark:bg-gray-400"></div>
                    <div class="space-y-3">
                        <div class="grid grid-cols-3 gap-4">

                            <div class="h-2 rounded col-span-1 bg-gray-500 dark:bg-gray-400"></div>
                            <div class="h-2 rounded col-span-2 bg-gray-500 dark:bg-gray-400"></div>
                        </div>

                    </div>
                    <div class="space-y-3">
                        <div class="grid grid-cols-3 gap-4">

                            <div class="h-2 rounded col-span-1 bg-gray-500 dark:bg-gray-400"></div>
                            <div class="h-2 rounded col-span-2 bg-gray-500 dark:bg-gray-400"></div>
                        </div>

                    </div>
                    <div class="space-y-3">
                        <div class="grid grid-cols-3 gap-4">

                            <div class="h-2 rounded col-span-1 bg-gray-500 dark:bg-gray-400"></div>
                            <div class="h-2 rounded col-span-2 bg-gray-500 dark:bg-gray-400"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <br>
    <h1 x-text="$store.token"></h1>
</main>

<script src="./assets/js/analytics-report.js"></script>

<script>
    new Litepicker({
        element: document.getElementById('dateRange'),
        //elementEnd: document.getElementById('end-date'),
        maxDays: 180,
        delimiter: '  To  ',
        //autoApply: false,
        //resetButton: true,
        autoRefresh: true,
        format: 'YYYY-MM-DD',
        singleMode: false,
        startDate: new Date(new Date().getTime() - 7 * 24 * 60 * 60 * 1000),
        endDate: new Date(),
        // tooltipText: {
        //     one: 'night',
        //     other: 'nights'
        // },
        allowRepick: true,
        tooltipNumber: (totalDays) => {
            return totalDays - 1;
        },
        plugins: ['ranges'],
        buttonText: {
            previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
            nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
        },
    });
</script>

<template x-if="$store.dark.on">
    <!-- LitePicker DateRange Styling -->
    <style>
        :root {
            /* change background color for .container__months */
            --litepicker-container-months-color-bg: #1f2937 !important;
            --litepicker-container-months-box-shadow-color: #111;
            --litepicker-footer-box-shadow-color: #111;
            --litepicker-month-header-color: #97999d;
            --litepicker-month-weekday-color: #c1c2c4;
            --litepicker-day-color: #97999d;
        }

        .container__predefined-ranges {
            color: #c1c2c4;
        }
    </style>
</template>





@endsection