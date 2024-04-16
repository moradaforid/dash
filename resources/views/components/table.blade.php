<!-- New Table -->
<div x-show="!$store.{{$name}}.loading && !$store.{{$name}}.noRecordsFound" class="w-full border border-gray-200 dark:border-gray-700 overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <template x-for="column in {{$columns}}">
                        <th class="px-4 py-3" x-text="column"></th>
                    </template>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                <template x-for="row in $store.{{$name}}.all_data">
                    <tr class="text-gray-700 dark:text-gray-400">
                        {{$tableRows}}
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
        <span class="flex items-center col-span-3" x-text="`Showing ${$store.{{$name}}.from}-${$store.{{$name}}.to} of ${$store.{{$name}}.total}`">

        </span>
        <span class="col-span-2"></span>

        <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
            <nav aria-label="Table navigation">
                <ul class="inline-flex items-center">

                    <li>

                        <div class="relative inline-flex self-center">
                            <span class="flex items-center mr-2">Show</span>
                            <select x-model.number="$store.{{$name}}.per_page" x-init="$watch('$store.{{$name}}.per_page', value => $store.{{$name}}.reset())" class="text-xs rounded border border-gray-200 dark:border-gray-500 text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-700 hover:border-gray-400 focus:outline-none appearance-none">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="500">500</option>
                            </select>
                        </div>

                    </li>


                    <li>
                        <button :disabled="!$store.{{$name}}.pre_btn" @click="$store.{{$name}}.prev()" class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
                            <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                        </button>
                    </li>

                    <li>
                        <button :disabled="!$store.{{$name}}.nex_btn" @click="$store.{{$name}}.next()" class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next">
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
<div x-show="$store.{{$name}}.loading" class="w-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 overflow-hidden rounded-lg shadow-xs p-4 mx-auto">
    <div class="animate-pulse flex space-x-4">

        <div class="flex-1 space-y-6 py-1">

            <!-- columns row -->
            <div class="h-2 rounded bg-gray-500 dark:bg-gray-400"></div>

            <template x-for="row in $store.{{$name}}.per_page * 2">
                <!-- row -->
                <div class="space-y-3">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="h-2 rounded col-span-1 bg-gray-500 dark:bg-gray-400"></div>
                        <div class="h-2 rounded col-span-2 bg-gray-500 dark:bg-gray-400"></div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

<!-- No records found -->
<div x-show="$store.{{$name}}.noRecordsFound" class="w-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 overflow-hidden rounded-lg shadow-xs p-4 mx-auto" style="display: none;">
    <div class="filament-tables-empty-state flex flex-1 flex-col items-center justify-center p-6 mx-auto space-y-6 text-center bg-white dark:bg-gray-800">
        <div class="flex items-center justify-center w-16 h-16 text-gray-700 dark:text-gray-400 rounded-full bg-gray-100 dark:bg-gray-700">
            <svg wire:loading.remove.delay="1" wire:target="previousPage,nextPage,gotoPage,sortTable,tableFilters,resetTableFiltersForm,tableSearchQuery,tableColumnSearchQueries,tableRecordsPerPage" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
        <div class="max-w-md space-y-1">
            <h2 class="text-xl font-bold tracking-tight text-gray-700 dark:text-gray-400">
                No records found
            </h2>
        </div>
    </div>
</div>

<!-- Modal backdrop. This what you want to place close to the closing body tag -->
<div x-data="{singular_name : '{{$singularName}}'}" x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center" style="display: none;">

    <!-- Edit Modal -->
    <div id="edit-modal" x-show="isModalOpen" @click.away="closeModal" @keydown.escape="closeModal" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0  transform translate-y-1/2" class="max-h-full overflow-y-auto w-full px-6 py-4 bg-gray-100 rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl" role="dialog">

        <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
        <header class="flex flex-row">
            <!-- Modal title -->
            <p x-text=" isCreateModalOpen ? 'Create ' + singular_name : (isEditModalOpen ? 'Edit ' + singular_name : '') " class="flex-1 text-lg font-semibold text-gray-700 dark:text-gray-300"></p>

            <button @click="closeModal" class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700" aria-label="close">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                    <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                </svg>
            </button>

        </header>



        <!-- Modal body -->

        <!-- Create/Edit Body -->
        <div x-show="isCreateModalOpen || isEditModalOpen">
            {{$modalInputs}}
        </div>

        <!-- Delete Body -->
        <div x-show="isDeleteModalOpen" class="flex flex-col items-center mt-4 mb-6 space-y-4">
            <svg class="w-20 h-20 mb-2 text-gray-700 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
            </svg>
            <!-- Modal title -->
            <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">Are you sure?</p>
            <!-- Modal description -->
            <p class="text-sm text-gray-700 dark:text-gray-400">Do you really want to delete it?
                This process cannot be undone.
            </p>
        </div>



        <footer class="flex flex-col justify-end sm:flex-row sm:space-x-4 space-y-3 sm:space-y-0 mt-2">
            <button @click="closeModal" class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 dark:border-gray-600 rounded-lg dark:text-white sm:px-4 sm:py-2 sm:w-auto bg-white dark:bg-gray-700 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                Cancel
            </button>

            <!-- create button -->
            <button x-show="isCreateModalOpen" @click="createItem()" :disabled="{{$disabledSave}}" class="disabled:opacity-50 w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Create
            </button>

            <!-- edit button -->
            <button x-show="isEditModalOpen" @click="editItem()" :disabled="{{$disabledSave}}" class="disabled:opacity-50 w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Save
            </button>

            <!-- delete button -->
            <button x-show="isDeleteModalOpen" @click="deleteItem()" class="disabled:opacity-50 w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Delete
            </button>

        </footer>

    </div>

</div>
<!-- End of modal backdrop -->



<script src="/assets/js/focus-trap.js"></script>

<script>
    document.addEventListener('alpine:init', () => {
        // Paginator Controller
        Alpine.store('{{ $name }}', {
            path: "{{ $crudPath }}",

            pre_btn: false,
            nex_btn: true,

            page: 1,
            per_page: 10,

            from: 1,
            to: 10,
            total: 0,

            loading: true,
            noRecordsFound: false,
            all_data: [],

            init() {
                this.getData()
            },

            next() {
                // this.pre_btn = true
                this.page += 1
                this.getData()
            },

            prev() {
                this.page -= 1
                this.getData()
            },

            reset() {
                this.page = 1
                this.getData()
            },

            getData() {
                this.token = Alpine.store('token')
                this.loading = true

                fetch(this.path + `/all?page=${this.page}&per_page=${this.per_page}`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then((response) => response.json())
                    .then((data) => {

                        if (data.total == 0) {
                            this.loading = false;
                            this.noRecordsFound = true;
                            return
                        }

                        !data.next_page_url ? this.nex_btn = false : this.nex_btn = true;
                        !data.prev_page_url ? this.pre_btn = false : this.pre_btn = true;

                        this.from = data.from
                        this.to = data.to
                        this.total = data.total

                        this.all_data = data.data

                        console.log(data)
                        this.loading = false
                        this.noRecordsFound = false

                    })

            },
        })
    })

    function modal() {
        return {
            // Modal
            isModalOpen: false,

            isCreateModalOpen: false,
            isEditModalOpen: false,
            isDeleteModalOpen: false,
            trapCleanup: null,
            editRow: '',
            crudPath: '{{ $crudPath }}',

            // Opening and Closing
            openDeleteModal(id) {
                this.deleteId = id
                this.isModalOpen = true
                this.isDeleteModalOpen = true
                this.trapCleanup = focusTrap(document.querySelector('#edit-modal'))
            },
            openCreateModal() {
                this.editRow = {}
                this.isModalOpen = true
                this.isCreateModalOpen = true
                this.trapCleanup = focusTrap(document.querySelector('#edit-modal'))
            },
            openEditModal(row) {
                this.editRow = {
                    ...row
                }
                this.isModalOpen = true
                this.isEditModalOpen = true
                this.trapCleanup = focusTrap(document.querySelector('#edit-modal'))
            },
            closeModal() {
                this.isModalOpen = false
                this.isDeleteModalOpen = false
                this.isCreateModalOpen = false
                this.isEditModalOpen = false
                this.trapCleanup()
            },

            // Operations
            deleteItem() {
                fetch(this.crudPath + '/' + this.deleteId, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            _token: Alpine.store('token'),
                        })
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        console.log(data);
                        if (data.status == 'deleted') {
                            Alpine.store('{{ $name }}').reset()
                            this.closeModal()
                        } else {
                            console.log("SOMETHING WRONG HAPPENED!");
                        }

                    })
                    .catch(err => console.log(err))
            },

            createItem() {
                this.editRow._token = Alpine.store('token')

                fetch(this.crudPath, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(this.editRow)
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        console.log(data);
                        if (data.status == 'created') {
                            Alpine.store('{{ $name }}').reset()
                            this.closeModal()
                        } else {
                            console.log("SOMETHING WRONG HAPPENED!");
                        }

                    })
                    .catch(err => console.log(err))
            },

            editItem() {
                this.editRow._token = Alpine.store('token')

                fetch(this.crudPath + '/' + this.editRow.id, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(this.editRow)
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        console.log(data);
                        if (data.status == 'updated') {
                            Alpine.store('{{ $name }}').reset()
                            this.closeModal()
                        } else {
                            console.log("SOMETHING WRONG HAPPENED!");
                        }

                    })
                    .catch(err => console.log(err))
            }
        }
    }
</script>