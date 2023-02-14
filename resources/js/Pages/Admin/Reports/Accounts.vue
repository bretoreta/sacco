<script setup>
import { reactive, ref } from 'vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import FiltersDropdown from '@/Components/FiltersDropdown.vue';
import Pagination from '@/Components/Pagination.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Checkbox from '@/Components/Checkbox.vue';
import Slider from '@vueform/slider'
import axios from 'axios';
import html2pdf from "html2pdf.js";
import { range } from 'lodash';

const pageprops = defineProps({
    accounts: Object,
});

const NumberFormat = Intl.NumberFormat(undefined, { style: 'currency', currency: 'KSH' });
const rangeFormat = (value) => {
    return `KSH. ${Math.round(value)}000`
}
const form = useForm({
    account_type: '',
    status: {
        active: false,
        frozen: false,
    },
    range: [0, 0]
});
const search = reactive({
    input: '',
});
const filtersLoading = ref();
const searchLoading = ref();
const pdfLoading = ref();

const applyFilters = () => {
    filtersLoading.value = true;
    search.input = '';
    
    if(range[1] == 0 || range[0] == 0)
    {
        range[0] = null;
        range[1] = null;
    }

    axios.post(route('admin.reports.accounts.filter'), form)
        .then((res) => {
            usePage().props.accounts = res.data
            usePage().props.flash.message = {
                    type: 'success',
                    message: 'Filtering Was Successfull. ' + res.data.data?.length + ' results found.'
                }
            filtersLoading.value = false;

            bannerTimeout();
        })
        .catch(error => {
            filtersLoading.value = false;
            if(error?.response.status === 422)
            {
                usePage().props.flash.message = {
                    type: 'error',
                    message: error.response.data.errors[0]
                }
            }
            
            usePage().props.flash.message = {
                type: 'error',
                message: 'Something Went Wrong Please Try Again Later'
            }

            bannerTimeout();
        })
}

const submitSearch = () => {
    searchLoading.value = true;
    form.reset();
    axios.post(route('admin.reports.accounts.search'), search)
        .then((res) => {
            usePage().props.accounts = res.data
            usePage().props.flash.message = {
                    type: 'success',
                    message: 'Search Was Successfull. ' + res.data.data?.length + ' results found.'
                }
            searchLoading.value = false;

            bannerTimeout();
        })
        .catch(error => {
            searchLoading.value = false;
            if(error?.response.status === 422)
            {
                console.log(error.response.data.errors);
                usePage().props.flash.message = {
                    type: 'error',
                    message: error.response.data.errors[0]
                }
            }
            
            usePage().props.flash.message = {
                type: 'error',
                message: 'Something Went Wrong Please Try Again Later'
            }

            bannerTimeout();
        })
}

const generatePdf = () => {
    pdfLoading.value = true;

    html2pdf(document.getElementById("accounts-report"), {
        margin: [5, 3],
        filename: 'Storm SACCO - Accounts Report.pdf',
        image: { type: 'jpeg', quality: 2 },
    });

    setTimeout(() => {
        pdfLoading.value = false
    }, 3000)
}

const resetFilters = () => {
    form.reset();
    router.visit(route('admin.reports.accounts.index'));
}

const bannerTimeout = () => {
    setTimeout(() => {
        usePage().props.flash.message = null
    }, 4000)
}
</script>

<template>
    <AdminLayout title="Accounts Report">
        <div class="py-6 md:py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-12 gap-5 px-4">
                    <div class="col-span-12">
                        <div class="pb-10">
                            <h4 class="text-3xl">Accounts Report</h4>
                            <div class="mt-5">
                                <div class="w-full">
                                    <div class="flex w-full items-center justify-between mb-4">
                                        <p class="text-gray-500 font-bold">Apply Filters For This Report</p>
                                        <button class="text-blue-500 text-xs font-semibold">Clear All</button>
                                    </div>
                                    <div class="flex flex-col md:flex-row md:space-x-8 space-y-2 md:space-y-0 items-start md:items-center w-full">
                                        <FiltersDropdown :align="'left'">
                                            <template #trigger>
                                                <button
                                                    class="bg-white px-6 py-3 shadow-sm text-gray-600 border border-gray-300 inline-flex justify-between items-center space-x-6 hover:bg-gray-50 active:bg-blue-100 focus:outline-none focus:border-blue-400 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                                                    <p>Account Type</p>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </button>
                                            </template>
                                            <template #content>
                                                <div class="p-5 w-full">
                                                    <p class="text-gray-600 text-sm font-bold mb-5 uppercase">Pick One</p>
                                                    <div class="flex flex-col space-y-3">
                                                        <div class="flex items-center cursor-pointer">
                                                            <input v-model="form.account_type" id="General Account" type="radio" value="General Account" name="default-radio" class="w-4 h-4 text-blue-500 bg-gray-100 border-gray-300 focus:ring-blue-400 focus:ring-2">
                                                            <label for="General Account" class="ml-2 text-sm cursor-pointer font-medium text-gray-900">General Account</label>
                                                        </div>
                                                        <div class="flex items-center cursor-pointer">
                                                            <input v-model="form.account_type" id="Savings Account" type="radio" value="Savings Account" name="default-radio" class="w-4 h-4 text-blue-500 bg-gray-100 border-gray-300 focus:ring-blue-400 focus:ring-2">
                                                            <label for="Savings Account" class="ml-2 text-sm cursor-pointer font-medium text-gray-900">Savings Account</label>
                                                        </div>
                                                        <div class="flex items-center cursor-pointer">
                                                            <input v-model="form.account_type" id="Contributions Account" type="radio" value="Contributions Account" name="default-radio" class="w-4 h-4 text-blue-500 bg-gray-100 border-gray-300 focus:ring-blue-400 focus:ring-2">
                                                            <label for="Contributions Account" class="ml-2 text-sm cursor-pointer font-medium text-gray-900">Contributions Account</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </FiltersDropdown>
                                        <FiltersDropdown :align="'left'">
                                            <template #trigger>
                                                <button
                                                    class="bg-white px-6 py-3 shadow-sm text-gray-600 border border-gray-300 inline-flex justify-between items-center space-x-6 hover:bg-gray-50 active:bg-blue-100 focus:outline-none focus:border-blue-400 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                                                    <p>Status</p>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </button>
                                            </template>
                                            <template #content>
                                                <div class="p-4 w-full">
                                                    <p class="text-gray-600 text-sm font-bold mb-5 uppercase">Tick All That Apply</p>
                                                    <div class="flex flex-col space-y-3">
                                                        <label class="flex items-center">
                                                            <Checkbox v-model:checked="form.status.active" name="active" />
                                                            <span class="ml-2 text-sm text-gray-600">Active Account</span>
                                                        </label>
                                                        <label class="flex items-center">
                                                            <Checkbox v-model:checked="form.status.frozen" name="frozen" />
                                                            <span class="ml-2 text-sm text-gray-600">Frozen Account</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </template>
                                        </FiltersDropdown>
                                        <FiltersDropdown :align="'left'">
                                            <template #trigger>
                                                <button
                                                    class="bg-white w-full px-5 py-3 shadow-sm text-gray-600 border border-gray-300 inline-flex justify-between items-center space-x-6 hover:bg-gray-50 active:bg-blue-100 focus:outline-none focus:border-blue-400 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                                                    <p>Available Balance</p>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </button>
                                            </template>
                                            <template #content>
                                                <div class="p-4 w-full">
                                                    <Slider v-model="form.range" :format="rangeFormat" class="slider-blue" />
                                                </div>
                                            </template>
                                        </FiltersDropdown>
                                        <div class="flex-1 w-full">   
                                            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                                            <form @submit.prevent="submitSearch">
                                                <div class="relative w-full">
                                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                                    </div>
                                                    <input v-model="search.input" type="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border bg-white focus:border-blue-400 focus:ring focus:ring-blue-300" :class="search.error ? 'border-red-500' : 'border-gray-300'" placeholder="Search By Transaction Number, User Name, ID Number or Phone..." required>
                                                    <button type="submit" :disabled="searchLoading" :class="{ 'opacity-75' : searchLoading }" class="text-white absolute right-2.5 bottom-2.5 bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-4 py-2">
                                                        <span v-if="searchLoading" class="flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 animate-spin">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                            </svg>
                                                            <p>Searching</p>
                                                        </span>
                                                        <span v-else>Search</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="mt-5 flex items-center justify-between">
                                        <div class="inline-flex items-center space-x-4">
                                            <primary-button @click="applyFilters" :disabled="filtersLoading" :class="{ 'opacity-75' : filtersLoading }" class="transition-all duration-300">
                                                <span v-if="filtersLoading" class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 animate-spin">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                    </svg>
                                                    <p>Loading</p>
                                                </span>
                                                <span v-else>Apply Filters</span>
                                            </primary-button>
                                            <secondary-button @click="resetFilters">Reset</secondary-button>
                                        </div>
                                        <div>
                                            <primary-button @click="generatePdf" :disabled="pdfLoading" :class="{ 'opacity-75' : pdfLoading }" class="transition-all duration-300">
                                                <span v-if="pdfLoading" class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 animate-spin">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                    </svg>
                                                    <p>Generating</p>
                                                </span>
                                                <span v-else>Generate Pdf</span>
                                            </primary-button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="accounts-report">
                            <div class="bg-white dark:bg-gray-800">
                                <div
                                    class="p-5 text-lg font-semibold text-left text-gray-900 dark:text-white">
                                    Accounts Report
                                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Compiled report of accounts records in the system</p>
                                </div>
                            </div>
                            <div class="relative overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Account Number
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Account Type
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Account Holder Details
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Status
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Available Balance
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="account in accounts.data" :key="account.id">
                                            <tr class="bg-white border-b hover:bg-gray-50">
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                                                    {{ account.uuid.substr(0, 9) + 'XXXX' }}
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{ account.account_type.name }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div>
                                                        <p class="font-bold">{{ account.user.name }}</p>
                                                        <p>Phone - {{ account.user.phone_number }}</p>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 uppercase">
                                                    <button v-if="account.status == 'active'" class="px-2 py-1 rounded-md shadow-md bg-green-500 text-white uppercase text-xs font-bold">
                                                        Active
                                                    </button>
                                                    <button v-else class="px-2 py-1 rounded-md shadow-md bg-gray-500 text-white uppercase text-xs font-bold">
                                                        Frozen
                                                    </button>
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ account.available_balance }}
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                                <div v-if="!accounts.data.length" class="bg-white w-full flex">
                                    <div class="w-full py-4"><p class="text-xs italic text-center">No Data Found</p></div>
                                </div>
                            </div>
                        </div>
                        <Pagination v-if="accounts.data.length" :data="accounts" />
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
<style src="@vueform/slider/themes/default.css"></style>
<style scoped>
.slider-blue {
  --slider-connect-bg: #3B82F6;
  --slider-tooltip-bg: #3B82F6;
  --slider-handle-ring-color: #3B82F630;
}
</style>