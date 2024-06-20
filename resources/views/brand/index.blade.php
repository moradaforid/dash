@extends('layouts.dashboard')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Brands')
@section('content')

<main class="h-full overflow-y-auto">
    <div x-data="modal()" class="container px-6 mx-auto grid">

        <!-- page title and create button -->
        <div class="flex justify-between mt-6">
            <div class="mb-3 mr-6">
                <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                    Brands
                </h2>
            </div>
            <div class="mb-3">
                <button @click="openCreateModal()" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Create
                </button>
            </div>
        </div>

        <x-table name="table_data" singularName="Brand" crudPath="{{ route('brand.index') }}" columns="['name', 'domain']" disabledSave="! (editRow.name && editRow.domain && editRow.logo && editRow.primary_color && editRow.secondary_color)">

            <x-slot name="tableRows">
                <td x-text="row.name" class="px-4 py-3 text-sm font-semibold"></td>
                <td x-text="row.domain" class="px-4 py-3 text-sm font-semibold"></td>
                <!-- <td class="px-4 py-3 text-sm" x-text="row.created_at ? row.created_at.split('T')[0] : 'N/A'"></td> -->
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-4 text-sm justify-end">
                        <button @click="openEditModal(row)" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                        </button>
                        <button @click="openDeleteModal(row.id)" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </td>
            </x-slot>

            <x-slot name="modalInputs">
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 py-6">
                    <label class="w-full block text-sm space-y-2">

                        <span class="text-gray-700 dark:text-gray-400">Name</span>
                        <input x-model="editRow.name" require="" class="w-full p-2 text-sm text-gray-700 placeholder-gray-50 bg-gray-50 border border-gray-300 dark:border-gray-400 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" placeholder="">

                        <span class="text-gray-700 dark:text-gray-400">Domain</span>
                        <input x-model="editRow.domain" require="" class="w-full p-2 text-sm text-gray-700 placeholder-gray-50 bg-gray-50 border border-gray-300 dark:border-gray-400 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" placeholder="">

                        <span class="text-gray-700 dark:text-gray-400">Logo</span>
                        <input x-model="editRow.logo" require="" class="w-full p-2 text-sm text-gray-700 placeholder-gray-50 bg-gray-50 border border-gray-300 dark:border-gray-400 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" placeholder="">

                        <span class="text-gray-700 dark:text-gray-400">Primary Color</span>
                        <input x-model="editRow.primary_color" require="" class="w-full p-2 text-sm text-gray-700 placeholder-gray-50 bg-gray-50 border border-gray-300 dark:border-gray-400 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" placeholder="">

                        <span class="text-gray-700 dark:text-gray-400">Secondary Color</span>
                        <input x-model="editRow.secondary_color" require="" class="w-full p-2 text-sm text-gray-700 placeholder-gray-50 bg-gray-50 border border-gray-300 dark:border-gray-400 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" placeholder="">

                    </label>
                </div>
            </x-slot>


        </x-table>




    </div>
    <br>


</main>





@endsection