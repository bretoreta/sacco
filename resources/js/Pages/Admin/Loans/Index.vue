<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TooltipMin from '@/Components/TooltipMin.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import Pagination from '@/Components/Pagination.vue';
import DialogModal from '@/Components/DialogModal.vue';

defineProps({
    loans: Object,
})

const NumberFormat = Intl.NumberFormat(undefined, { style: 'currency', currency: 'KES'});
const pendingLoans = usePage().props.loans.data.filter(loan => {
    return loan.status == 'pending';
});
const approvedLoans = usePage().props.loans.data.filter(loan => {
    return loan.status == 'approved';
});
const rejectedLoans = usePage().props.loans.data.filter(loan => {
    return loan.status == 'rejected';
});
const editingLoanType = ref(false);

const bannerTimeout = () => {
    setTimeout(() => {
        usePage().props.flash.message = null
    }, 4000)
}
</script>

<template>
    <AdminLayout title="Manage Loans">
        <div class="py-6 md:py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-12 gap-5 px-4">
                    <div class="col-span-12 md:col-span-8">
                        <div class="p-5 text-lg sm:rounded-t-xl font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                            Browse Loans
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
                        </div>
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Loan Type
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Applicant
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Amount Applied
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="loan in loans.data" :key="loan.id">
                                        <tr class="bg-white border-b hover:bg-gray-50">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ loan.loan.loan_type }}
                                            </th>
                                            <td class="px-6 py-4">
                                                <div>
                                                    <p>{{ loan.user.name }}</p>
                                                    <p>ID - {{ loan.user.id_number }}</p>
                                                    <p>Phone - {{ loan.user.phone_number }}</p>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ NumberFormat.format(loan.amount_payable) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <button v-if="loan.status == 'pending'" class="px-2 py-1 rounded-md shadow-md bg-gray-500 text-white uppercase text-xs font-bold">
                                                    {{ loan.status }}
                                                </button>
                                                <button v-if="loan.status == 'approved'" class="px-2 py-1 rounded-md shadow-md bg-green-500 text-white uppercase text-xs font-bold">
                                                    {{ loan.status }}
                                                </button>
                                                <button v-if="loan.status == 'rejected'" class="px-2 py-1 rounded-md shadow-md bg-red-500 text-white uppercase text-xs font-bold">
                                                    {{ loan.status }}
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                            <div v-if="!loans.data.length" class="bg-white w-full flex">
                                <div class="w-full py-4"><p class="text-xs italic text-center">No Data Found</p></div>
                            </div>
                        </div>
                        <Pagination v-if="loans.data.length" :data="loans" />
                    </div>
                    <div class="col-span-12 md:col-span-4">
                        <div class="bg-white rounded-lg shadow-md border border-gray-300 p-6">
                            <div class="text-lg font-bold text-left text-gray-900 bg-white">
                                Loan Applications Overview
                                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play.</p>
                            </div>
                            <div class="mt-5">                               
                                <div class="text-gray-900 bg-white border border-gray-200 rounded-lg">
                                    <button type="button" class="relative group inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                        <span class="flex items-center justify-between w-full">
                                            <span class="inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                </svg>
                                                All Loans
                                            </span>
                                            <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-gray-400 group-hover:bg-blue-500 rounded-full">{{ loans.data.length }}</span>
                                        </span>
                                    </button>
                                    <button type="button" class="relative group inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                        <span class="flex items-center justify-between w-full">
                                            <span class="inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                                Approved Loans
                                            </span>
                                            <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-gray-400 group-hover:bg-blue-500 rounded-full">{{ approvedLoans.length }}</span>
                                        </span>
                                    </button>
                                    <button type="button" class="relative group inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                        <span class="flex items-center justify-between w-full">
                                            <span class="inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                                </svg>
                                                Pending Loans
                                            </span>
                                            <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-gray-400 group-hover:bg-blue-500 rounded-full">{{ pendingLoans.length }}</span>
                                        </span>
                                    </button>
                                    <button type="button" class="relative group inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                        <span class="flex items-center justify-between w-full">
                                            <span class="inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Rejected Loans
                                            </span>
                                            <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-gray-400 group-hover:bg-blue-500 rounded-full">{{ rejectedLoans.length }}</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>