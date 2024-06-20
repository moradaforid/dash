<?php $__env->startSection('pageTitle', isset($pageTitle) ? $pageTitle : 'Report'); ?>
<?php $__env->startSection('content'); ?>

<!-- Litepicker library -->
<script src="/assets/js/litePicker.js"></script>

<main class="h-full overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Report
        </h2>



        <form @submit.prevent="$store.report.getData()" class="flex flex-col flex-wrap mb-4 space-y-4 md:flex-row md:items-end md:space-x-4">

            <!-- Group By Selector -->
            <ul class="flex flex-col sm:flex-row">
                <li class="inline-flex items-center gap-x-2.5 py-2.5 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    <span class="w-full text-gray-600 dark:text-gray-400 py-auto font-semibold uppercase">Group By</span>
                </li>

                <li class="inline-flex items-center gap-x-2.5 py-2.5 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    <div class="relative flex items-start w-full">
                        <div class="flex items-center h-5">
                            <input x-model="$store.report.group" value="apps" id="hs-horizontal-list-group-item-radio-1" name="hs-horizontal-list-group-item-radio" type="radio" class="border-gray-200 rounded-full dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" checked>
                        </div>
                        <label for="hs-horizontal-list-group-item-radio-1" class="ml-3 block w-full text-sm text-gray-600 dark:text-gray-400">
                            Apps
                        </label>
                    </div>
                </li>

                <li class="inline-flex items-center gap-x-2.5 py-2.5 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    <div class="relative flex items-start w-full">
                        <div class="flex items-center h-5">
                            <input x-model="$store.report.group" value="adunits" id="hs-horizontal-list-group-item-radio-2" name="hs-horizontal-list-group-item-radio" type="radio" class="border-gray-200 rounded-full dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                        </div>
                        <label for="hs-horizontal-list-group-item-radio-2" class="ml-3 block w-full text-sm text-gray-600 dark:text-gray-400">
                            Ad units
                        </label>
                    </div>
                </li>

                <li class="inline-flex items-center gap-x-2.5 py-2.5 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    <div class="relative flex items-start w-full">
                        <div class="flex items-center h-5">
                            <input x-model="$store.report.group" value="days" id="hs-horizontal-list-group-item-radio-3" name="hs-horizontal-list-group-item-radio" type="radio" class="border-gray-200 rounded-full dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
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
        <div x-show="!$store.report.loading" x-init="$store.report.getData()" class="w-full border border-gray-200 dark:border-gray-700 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <template x-for="column in $store.report.columns">
                                <th class="px-4 py-3" x-text="column"></th>
                            </template>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                        <template x-for="row in $store.table_paginator.listed_data">
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td x-text="row.name" class="px-4 py-3 text-sm font-semibold"></td>
                                <td class="px-4 py-3 text-sm" x-text="row.impressions"></td>
                                <td class="px-4 py-3 text-sm" x-text="row.clicks"></td>
                                <td class="px-4 py-3 text-sm" x-text="row.ctr + ' %'"></td>
                                <td class="px-4 py-3 text-sm" x-text="'$ ' + row.revenue"></td>

                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3" x-text="`Showing ${$store.table_paginator.first_item+1}-${$store.table_paginator.last_item} of ${$store.table_paginator.all_data.length}`">

                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                    <nav aria-label="Table navigation">
                        <ul class="inline-flex items-center">

                            <li>

                                <div class="relative inline-flex self-center">
                                    <span class="flex items-center mr-2">Show</span>
                                    <select x-model.number="$store.table_paginator.pager" x-init="$watch('$store.table_paginator.pager', value => $store.table_paginator.reset_paginator())" class="text-xs rounded border border-gray-200 dark:border-gray-500 text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-700 hover:border-gray-400 focus:outline-none appearance-none">
                                        <option value="1">1</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="500">500</option>
                                    </select>
                                </div>

                            </li>


                            <li>
                                <button :disabled="!$store.table_paginator.pre_btn" @click="$store.table_paginator.prev()" class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
                                    <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </li>

                            <li>
                                <button :disabled="!$store.table_paginator.nex_btn" @click="$store.table_paginator.next()" class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next">
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
        <div x-show="$store.report.loading" class="w-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 overflow-hidden rounded-lg shadow-xs p-4 mx-auto">
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
</main>

<script>
    document.addEventListener('alpine:init', () => {

        // Dark Light Theme Controller
        Alpine.store('report', {

            columns: ['name', 'impressions', 'clicks', 'ctr', 'revenue'],
            adunits: [],
            apps: [],
            days: [],
            token: '',
            loading: true,
            group: 'apps',
            data: [],

            getData() {
                this.token = Alpine.store('token')
                this.loading = true
                this.rangeDate = document.getElementById('dateRange').value;
                this.startDate = this.rangeDate.split('  To  ')[0];
                this.endDate = this.rangeDate.split('  To  ')[1];

                fetch('/report', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            startDate: this.startDate,
                            endDate: this.endDate,
                            group: this.group,
                            _token: this.token,
                        })
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (this.group == 'apps') {
                            this.updateAppsTable(data)
                        } else if (this.group == 'adunits') {
                            this.updateAdunitsTable(data)
                        } else if (this.group == 'days') {
                            //
                        }

                    })

            },

            updateAdunitsTable(data) {
                //console.log('hellooooo' + adunit.name);
                //console.log('hellooooo' + data);
                // tableData.value = [];
                data.forEach(adunit => {
                    //console.log(adunit.reports[0]['revenue']);

                    // let name = adunit.name;
                    adunit.impressions = 0;
                    adunit.clicks = 0;
                    adunit.revenue = 0;

                    adunit.reports.forEach(report => {
                        adunit.impressions += report.impressions;
                        adunit.clicks += report.clicks;
                        adunit.revenue += report.revenue;
                    });

                    adunit.ctr = adunit.clicks * 100 / adunit.impressions || 0;

                    adunit.ctr = adunit.ctr.toFixed(2)
                    // tableData.value.push([name, impressions, clicks, ctr.toFixed(2) + ' %', '$ ' + revenue.toFixed(2)])
                })


                Alpine.store('table_paginator').all_data = data
                Alpine.store('table_paginator').reset_paginator()

                this.loading = false
            },

            updateAppsTable(data) {

                data.forEach(app => {
                    app.impressions = 0;
                    app.clicks = 0;
                    app.revenue = 0;

                    app.adunits.forEach(adunit => {
                        adunit.reports.forEach(report => {
                            app.impressions += report.impressions;
                            app.clicks += report.clicks;
                            app.revenue += report.revenue;
                        })
                    })

                    app.ctr = app.clicks * 100 / app.impressions || 0;
                    app.ctr = app.ctr.toFixed(2)

                })

                Alpine.store('table_paginator').all_data = data
                Alpine.store('table_paginator').reset_paginator()

                this.loading = false

            },


        })
    })
</script>

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





<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\21265\Desktop\Projects\laravel-vue\resources\views/report.blade.php ENDPATH**/ ?>