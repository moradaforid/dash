@extends('layouts.dashboard')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Roles')
@section('content')


<main class="h-full overflow-y-auto">
    <div x-data="modal()" class="container px-6 mx-auto grid">

        <!-- page title and create button -->
        <div class="flex justify-between mt-6">
            <div class="mb-3 mr-6">
                <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                    Roles
                </h2>
            </div>
            <div class="mb-3">
                <button @click="openCreateModal()" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Create
                </button>
            </div>
        </div>

        <x-table name="table_data" singularName="Role" crudPath="{{ route('role.index') }}" columns="['name', 'created at']" disabledSave="!editRow.name">

            <x-slot name="tableRows">
                <td x-text="row.name" class="px-4 py-3 text-sm font-semibold"></td>
                <td class="px-4 py-3 text-sm" x-text="row.created_at ? row.created_at.split('T')[0] : 'N/A'"></td>
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
                <div x-data="roleManager" class="grid grid-cols-1 sm:grid-cols-2 gap-5 py-5">
                    <label class="block flex flex-col text-sm space-y-2 col-span-1">
                        <span class="text-gray-700 dark:text-gray-400">Sponsor</span>
                        <select x-model="editRow.sponsor_id" x-init="$watch('editRow.sponsor_id', value => changeSponsor())" class="text-sm rounded border border-gray-200 dark:border-gray-400 text-gray-500 dark:text-gray-200 bg-white dark:bg-gray-700 hover:border-gray-400 focus:outline-none appearance-none">
                            <template x-for="sp in sponsors">
                                <option :value="sp.id" x-text="sp.name" :selected="editRow.sponsor_id == sp.id"></option>
                            </template>
                        </select>
                    </label>
                </div>

                <script>
                    function roleManager() {

                        return {
                            permissions: @json($permissions),
                            selectedCountries: [],

                            init() {
                                //



                                options
                                selected: by id or by name

                                changer()






                            },

                        }
                    }
                </script>
            </x-slot>

        </x-table>





    </div>
    <br>


</main>


@endsection