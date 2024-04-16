@extends('layouts.dashboard')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Offer')
@section('content')

<main class="h-full overflow-y-auto">
    <div x-data="modal()" class="container px-6 mx-auto grid">

        <!-- page title and create button -->
        <div class="flex justify-between mt-6">
            <div class="mb-3 mr-6">
                <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                    Offers
                </h2>
            </div>
            <div class="mb-3">
                <button @click="openCreateModal()" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Create
                </button>
            </div>
        </div>

        <x-table name="table_data" singularName="Offer" crudPath="{{ route('offer.index') }}" columns="['name','sponsor','status', 'created at']" disabledSave="!editRow.name">

            <x-slot name="tableRows">
                <td x-text="row.name" class="px-4 py-3 text-sm font-semibold"></td>
                <td x-text="row.sponsor.name" class="px-4 py-3 text-sm font-semibold"></td>
                <td x-text="row.status" class="px-4 py-3 text-sm font-semibold"></td>
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
                <div x-data="offerManager" class="grid grid-cols-1 sm:grid-cols-2 gap-5 py-5">
                    <label class="block flex flex-col text-sm space-y-2 col-span-1">
                        <span class="text-gray-700 dark:text-gray-400">Sponsor</span>
                        <select x-model="editRow.sponsor_id" x-init="$watch('editRow.sponsor_id', value => changeSponsor())" class="text-sm rounded border border-gray-200 dark:border-gray-400 text-gray-500 dark:text-gray-200 bg-white dark:bg-gray-700 hover:border-gray-400 focus:outline-none appearance-none">
                            <template x-for="sp in sponsors">
                                <option :value="sp.id" x-text="sp.name" :selected="editRow.sponsor_id == sp.id"></option>
                            </template>
                        </select>
                    </label>

                    <label class="block text-sm space-y-2 col-span-1">
                        <span class="text-gray-700 dark:text-gray-400">Offer ID</span>
                        <div class="flex flex-row space-x-2 items-center">
                            <input x-model="editRow.sponsor_offer_id" class="w-full p-2 text-sm text-gray-700 placeholder-gray-50 bg-gray-50 border border-gray-300 dark:border-gray-400 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" placeholder="">

                            <div>
                                <button @click="getOfferData" title="Search action" type="button" :disabled="isLoading" class="flex items-center justify-center rounded-full relative outline-none hover:bg-gray-200 disabled:opacity-70 disabled:cursor-not-allowed disabled:pointer-events-none text-gray-700 dark:text-gray-400 focus:bg-primary-500/10 dark:hover:bg-gray-300/5 w-10 h-10 -my-2">
                                    <span class="sr-only">
                                        Search action
                                    </span>

                                    <svg x-show="!isLoading" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>

                                    <svg x-show="isLoading" class="animate-spin w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd" d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="currentColor"></path>
                                        <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"></path>
                                    </svg>

                                </button>
                            </div>

                        </div>
                    </label>

                    <label class="w-full block text-sm space-y-2">
                        <span class="text-gray-700 dark:text-gray-400">Name</span>
                        <input x-model="editRow.name" require="" class="w-full p-2 text-sm text-gray-700 placeholder-gray-50 bg-gray-50 border border-gray-300 dark:border-gray-400 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" placeholder="">
                    </label>

                    <label class="w-full block text-sm space-y-2">
                        <span class="text-gray-700 dark:text-gray-400">Category</span>
                        <input x-model="editRow.category_id" require="" class="w-full p-2 text-sm text-gray-700 placeholder-gray-50 bg-gray-50 border border-gray-300 dark:border-gray-400 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" placeholder="">
                    </label>

                    <label class="w-full block text-sm space-y-2">
                        <span class="text-gray-700 dark:text-gray-400">Description</span>
                        <input x-model="editRow.description" require="" class="w-full p-2 text-sm text-gray-700 placeholder-gray-50 bg-gray-50 border border-gray-300 dark:border-gray-400 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" placeholder="">
                    </label>

                    <label class="w-full block text-sm space-y-2">
                        <span class="text-gray-700 dark:text-gray-400">Link</span>
                        <input x-model="editRow.link" require="" class="w-full p-2 text-sm text-gray-700 placeholder-gray-50 bg-gray-50 border border-gray-300 dark:border-gray-400 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" placeholder="">
                    </label>

                    <label class="w-full block text-sm space-y-2">
                        <span class="text-gray-700 dark:text-gray-400">Status</span>
                        <input x-model="editRow.status" require="" class="w-full p-2 text-sm text-gray-700 placeholder-gray-50 bg-gray-50 border border-gray-300 dark:border-gray-400 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" placeholder="">
                    </label>

                    <label class="w-full block text-sm space-y-2">
                        <span class="text-gray-700 dark:text-gray-400">Countries</span>
                        <input x-model="editRow.countries" require="" class="w-full p-2 text-sm text-gray-700 placeholder-gray-50 bg-gray-50 border border-gray-300 dark:border-gray-400 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" placeholder="">
                    </label>

                    <label class="w-full block text-sm space-y-2">
                        <span class="text-gray-700 dark:text-gray-400">Banner Image</span>
                        <input x-model="editRow.image_banner" require="" class="w-full p-2 text-sm text-gray-700 placeholder-gray-50 bg-gray-50 border border-gray-300 dark:border-gray-400 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" placeholder="">
                    </label>

                    <label class="w-full block text-sm space-y-2">
                        <span class="text-gray-700 dark:text-gray-400">Interstitial Image</span>
                        <input x-model="editRow.image_inter" require="" class="w-full p-2 text-sm text-gray-700 placeholder-gray-50 bg-gray-50 border border-gray-300 dark:border-gray-400 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" placeholder="">
                    </label>


                    <label class="w-full block text-sm space-y-2">
                        <span class="text-gray-700 dark:text-gray-400">Countries</span>

                        <!-- dropdown -->
                        <div class="relative w-full text-sm text-gray-700 placeholder-gray-50 bg-gray-50 border border-gray-300 dark:border-gray-400 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple">
                            <div class="p-2">
                                Select Countries
                            </div>
                            <div class="absolute max-h-36 overflow-y-auto mt-2 right-0 left-0">
                                <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="p-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-600" aria-label="submenu">
                                    <template x-for="item in countries">
                                        <li @click="changeSelectedCountries(item.id)" class="flex inline-flex items-center space-x-2 w-full p-2 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                            <div class="w-4 h-4 rounded border dark:border-gray-200">
                                                <svg x-show="editRow.countries.some(obj => obj.id === item.id)" class="w-full" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
                                                </svg>
                                            </div>
                                            <span x-text="item.name"></span>
                                        </li>
                                    </template>

                                </ul>
                            </div>

                            <h3 x-text="this.editRow.countries"></h3>

                        </div>


                    </label>




                </div>

                <script>
                    function offerManager() {

                        return {
                            countries: @json($countries),
                            selectedCountries: [],
                            changeSelectedCountries(id) {
                                // isIn = this.editRow.countries.some(obj => obj.id == id)
                                // console.log(isIn);

                                // console.log(this.editRow.countries);

                                if (!this.editRow.countries) {
                                    this.editRow.countries = [];
                                }

                                st = {}

                                // for (let index = 0; index < this.editRow.countries.length; index++) {
                                //     if (this.editRow.countries[index].id == id) {
                                //         st.in = true
                                //         st.index = index
                                //         break
                                //     }
                                // }

                                this.editRow.countries.forEach((e, index) => {
                                    if (e.id == id) {
                                        st.in = true
                                        st.index = index
                                        return
                                    }
                                });


                                if (st.in) {
                                    this.editRow.countries.splice(st.index, 1)
                                } else {
                                    this.editRow.countries.push({
                                        id: id
                                    })
                                }

                                console.log(this.editRow.countries);


                            },
                            isLoading: false,
                            sponsors: @json($sponsors),
                            sponsor: {},
                            testoo: [1, 2],
                            init() {
                                // sponsors
                                if (this.editRow.sponsor_id) {
                                    this.changeSponsor()
                                } else {
                                    this.editRow.sponsor_id = this.sponsors[0].id;
                                    this.sponsor = this.sponsors[0];
                                }

                                // countries

                            },
                            changeSponsor() {
                                // this.editRow.sponsor_id = this.sponsorId;
                                this.sponsors.forEach(s => {
                                    if (s.id == this.sponsorId) {
                                        this.sponsor = s;
                                        return
                                    }
                                });
                            },
                            getOfferData() {
                                this.isLoading = true,
                                    fetch(this.sponsor.api_link + '/campaigns/' + this.editRow.sponsor_offer_id, {
                                        method: 'GET',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'Authorization': 'Bearer ' + this.sponsor.api_token,
                                        }
                                    })
                                    .then((response) => response.json())
                                    .then((data) => {
                                        console.log(data);
                                        this.isLoading = false;

                                        if (data.status) {
                                            this.editRow.name = data.data.name;
                                            this.editRow.description = data.data.description;
                                            this.editRow.status = data.data.status;
                                            this.editRow.link = data.data.redirect[0].url;
                                        }


                                    })
                                    .catch(err => console.log(err))
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