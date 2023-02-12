<script setup>
import { reactive, ref } from 'vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import FiltersDropdown from '@/Components/FiltersDropdown.vue';
import Pagination from '@/Components/Pagination.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Checkbox from '@/Components/Checkbox.vue';
import 'v-calendar/dist/style.css';
import axios from 'axios';

const pageprops = defineProps({
    transactions: Object,
});

const NumberFormat = Intl.NumberFormat(undefined, { style: 'currency', currency: 'KSH' });
const form = useForm({
    date: {
        start: null,
        end: null
    },
    day: null,
    for: {
        loan_disbursement: false,
        loan_repayment: false,
        contribution: false,
        deposit: false
    },
});
const search = reactive({
    input: '',
    error: '',
});
const loading = ref();

const applyFilters = () => {
    loading.value = true;

    if(form.date.start && form.date.end && form.day)
    {
        form.date.start = null;
        form.date.end = null;
    }

    axios.post(route('admin.reports.transactions.filter'), form)
        .then((res) => {
            usePage().props.transactions = res.data
            loading.value = false;
        })
        .catch(error => {
            loading.value = false;
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
        })
}

const exportToPdf = () => {
    router.post(route('admin.transactions.generatepdf'), pageprops.transactions, {
        onSuccess: () => {
            form.reset()
        }
    });
}

const resetFilters = () => {
    form.reset();
    router.visit(route('admin.reports.transactions.index'));
}

const bannerTimeout = () => {
    setTimeout(() => {
        usePage().props.flash.message = null
    }, 4000)
}
</script>

<template>
    <AdminLayout title="Transactions Report">
        <div class="py-6 md:py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-12 gap-5 px-4">
                    <div class="col-span-12">
                        <div class="pb-10">
                            <h4 class="text-3xl">Generate Transactions Report</h4>
                            <div class="mt-5">
                                <div class="w-full">
                                    <div class="flex w-full items-center justify-between mb-4">
                                        <p class="text-gray-500 font-bold">Apply Filters For This Report</p>
                                        <button class="text-blue-500 text-xs font-semibold">Clear All</button>
                                    </div>
                                    <div class="flex flex-col md:flex-row md:space-x-10 space-y-2 md:space-y-0 items-start md:items-center w-full">
                                        <FiltersDropdown :align="'left'">
                                            <template #trigger>
                                                <button
                                                    class="bg-white px-6 py-3 shadow-sm text-gray-600 border border-gray-300 inline-flex justify-between items-center space-x-6 hover:bg-gray-50 active:bg-blue-100 focus:outline-none focus:border-blue-400 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                                                    <p>Loan For</p>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </button>
                                            </template>
                                            <template #content>
                                                <div class="p-5 w-full">
                                                    <p class="text-gray-600 text-sm font-bold mb-5 uppercase">Tick all that apply</p>
                                                    <div class="flex flex-col space-y-3">
                                                        <label class="flex items-center">
                                                            <Checkbox v-model:checked="form.for.loan_disbursement" name="loan_disbursement" />
                                                            <span class="ml-2 text-sm text-gray-600">Loan Disbursement</span>
                                                        </label>
                                                        <label class="flex items-center">
                                                            <Checkbox v-model:checked="form.for.loan_repayment" name="loan_repayment" />
                                                            <span class="ml-2 text-sm text-gray-600">Loan Repayment</span>
                                                        </label>
                                                        <label class="flex items-center">
                                                            <Checkbox v-model:checked="form.for.contribution" name="contribution" />
                                                            <span class="ml-2 text-sm text-gray-600">Contribution</span>
                                                        </label>
                                                        <label class="flex items-center">
                                                            <Checkbox v-model:checked="form.for.deposit" name="deposit" />
                                                            <span class="ml-2 text-sm text-gray-600">Deposit</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </template>
                                        </FiltersDropdown>
                                        <FiltersDropdown :align="'left'">
                                            <template #trigger>
                                                <button
                                                    class="bg-white px-6 py-3 shadow-sm text-gray-600 border border-gray-300 inline-flex justify-between items-center space-x-6 hover:bg-gray-50 active:bg-blue-100 focus:outline-none focus:border-blue-400 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                                                    <p>Specific Day</p>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </button>
                                            </template>
                                            <template #content>
                                                <div class="p-4 w-full">
                                                    <v-date-picker v-model="form.day" mode="date" />
                                                </div>
                                            </template>
                                        </FiltersDropdown>
                                        <FiltersDropdown :align="'left'">
                                            <template #trigger>
                                                <button
                                                    class="bg-white w-full px-6 py-3 shadow-sm text-gray-600 border border-gray-300 inline-flex justify-between items-center space-x-6 hover:bg-gray-50 active:bg-blue-100 focus:outline-none focus:border-blue-400 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                                                    <p>Date Range</p>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </button>
                                            </template>
                                            <template #content>
                                                <div class="p-4 w-full">
                                                    <v-date-picker v-model="form.date" mode="datetime" is-range />
                                                </div>
                                            </template>
                                        </FiltersDropdown>
                                        <div class="flex-1 w-full">   
                                            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                                            <div class="relative w-full">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                                </div>
                                                <input v-model="search.input" type="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border bg-white focus:border-blue-400 focus:ring focus:ring-blue-300" :class="search.error ? 'border-red-500' : 'border-gray-300'" placeholder="Search By Transaction Number, User Name, ID Number or Phone..." required>
                                                <button type="button" class="text-white absolute right-2.5 bottom-2.5 bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-4 py-2">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-5 inline-flex items-center space-x-4">
                                        <primary-button @click="applyFilters" :disabled="loading" :class="{ 'opacity-75' : loading }" class="transition-all duration-300">
                                            <span v-if="loading" class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 animate-spin">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                </svg>
                                                <p>Loading</p>
                                            </span>
                                            <span v-else>Apply Filters</span>
                                        </primary-button>
                                        <secondary-button @click="resetFilters">Reset</secondary-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between  bg-white dark:bg-gray-800 ">
                            <div
                                class="p-5 text-lg font-semibold text-left text-gray-900 dark:text-white">
                                Transactions Report
                                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of
                                    Flowbite products designed to help you work and play, stay organized..</p>
                            </div>
                            <a :href="route('admin.reports.transactions.generatepdf')">Export To PDF</a>
                        </div>
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Transaction
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            In Favor Of
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Initiated By
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            For
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Amount
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="transaction in transactions.data" :key="transaction.id">
                                        <tr class="bg-white border-b hover:bg-gray-50">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                                                {{ transaction.uuid.substr(0, 7) + '...' }}
                                            </th>
                                            <td class="px-6 py-4">
                                                <div>
                                                    <p>{{ transaction.user.name }}</p>
                                                    <p>ID - {{ transaction.user.id_number }}</p>
                                                    <p>Phone - {{ transaction.user.phone_number }}</p>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ transaction.actor.name }}
                                            </td>
                                            <td class="px-6 py-4 uppercase">
                                                {{ transaction.for }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <button v-if="transaction.type == 'debit'" class="px-2 py-1 rounded-md shadow-md bg-red-500 text-white uppercase text-xs font-bold">
                                                    {{ NumberFormat.format(transaction.amount) }}
                                                </button>
                                                <button v-if="transaction.type == 'credit'" class="px-2 py-1 rounded-md shadow-md bg-green-500 text-white uppercase text-xs font-bold">
                                                    {{ NumberFormat.format(transaction.amount) }}
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                            <div v-if="!transactions.data.length" class="bg-white w-full flex">
                                <div class="w-full py-4"><p class="text-xs italic text-center">No Data Found</p></div>
                            </div>
                        </div>
                        <Pagination v-if="transactions.data.length" :data="transactions" />
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>