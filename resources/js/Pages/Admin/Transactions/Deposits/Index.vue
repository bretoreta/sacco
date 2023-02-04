<script setup>
import { usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import DialogModal from '@/Components/DialogModal.vue';

const pageprops = defineProps({
    transactions: Object,
});

const NumberFormat = Intl.NumberFormat(undefined, { style: 'currency', currency: 'KSH' });

const bannerTimeout = () => {
    setTimeout(() => {
        usePage().props.flash.message = null
    }, 4000)
}
</script>

<template>
    <AdminLayout title="Deposit Transactions Overview">
        <div class="py-6 md:py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-12 gap-5 px-4">
                    <div class="col-span-12 my-5">
                        <div class="py-3">
                            <h4 class="text-3xl font-bold text-gray-700">Deposit Transactions Overview</h4>
                        </div>
                        <!-- <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-1">
                                <div class="bg-blue-500 rounded-lg shadow-md border border-blue-300 p-6">
                                    <p class="text-white font-bold text-xs uppercase">Loan Disbursements Usage</p>
                                    <div class="mt-5">
                                        <h4 class="text-2xl font-bold text-blue-200">{{ NumberFormat.format(loan_disbursements_sum ?? 0) }} <span class="text-blue-300 text-xs">In Total</span></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="bg-blue-500 rounded-lg shadow-md border border-blue-300 p-6">
                                    <p class="text-white font-bold text-xs uppercase">Loan Repayments Collected</p>
                                    <div class="mt-5">
                                        <h4 class="text-2xl font-bold text-blue-200">{{ NumberFormat.format(loan_repayments_sum ?? 0) }} <span class="text-blue-300 text-xs">In Total</span></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="bg-blue-500 rounded-lg shadow-md border border-blue-300 p-6">
                                    <p class="text-white font-bold text-xs uppercase">Contributions Collected</p>
                                    <div class="mt-5">
                                        <h4 class="text-2xl font-bold text-blue-200">{{ NumberFormat.format(contributions_sum ?? 0) }} <span class="text-blue-300 text-xs">In Total</span></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="bg-blue-500 rounded-lg shadow-md border border-blue-300 p-6">
                                    <p class="text-white font-bold text-xs uppercase">Deposits Collected</p>
                                    <div class="mt-5">
                                        <h4 class="text-2xl font-bold text-blue-200">{{ NumberFormat.format(deposits_sum ?? 0) }} <span class="text-blue-300 text-xs">In Total</span></h4>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="col-span-12">
                        <div class="p-5 text-lg sm:rounded-t-xl font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                            Browse Deposit Transactions
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
                        </div>
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            UUID
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