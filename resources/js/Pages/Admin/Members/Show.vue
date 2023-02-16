<script setup>
import { reactive } from '@vue/reactivity';
import { router, usePage } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue';
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import TooltipMin from '@/Components/TooltipMin.vue';
import CircularProgress from '@/Components/CircularProgress.vue';

const pageprops = defineProps({
    member: Object,
    loans: Object,
});

const search = reactive({
    input: '',
});

const NumberFormat = Intl.NumberFormat(undefined, { style: 'currency', currency: 'KSH' });

const activateAccount = (id) => {
    router.put(route('admin.accounts.activate', id), {}, {
        preserveScroll: true,
        onSuccess: () => {
            bannerTimeout()
        }
    })
}

const freezeAccount = (id) => {
    router.put(route('admin.accounts.freeze', id), {}, {
        preserveScroll: true,
        onSuccess: () => {
            bannerTimeout()
        }
    })
}

const bannerTimeout = () => {
    setTimeout(() => {
        usePage().props.flash.message = null
    }, 4000)
}
</script>

<template>
    <AdminLayout title="Showing Member">
        <div class="py-6 md:py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-12 gap-5 px-4">
                    <div class="mt-5 col-span-12 md:col-span-8 gap-6">
                        <div class="bg-gradient-to-r from-blue-800 to-indigo-900 min-h-[200px] shadow-md rounded-t-md">
                        </div>
                        <div class="rounded-full w-40 h-40 -mt-20 ml-10">
                            <img :src="member.profile_photo_url" class="h-40 w-40 rounded-full object-cover border-4 border-white">
                        </div>
                        <div class="bg-white border-l border-r border-b border-gray-300 shadow-md -mt-20">
                            <div class="flex items-center justify-between pr-5 md:pr-14">
                                <div class="px-5 pt-20 pb-10">
                                    <div class="mt-5 px-4">
                                        <h4 class="text-4xl text-gray-700 font-bold inline-flex items-center space-x-2">
                                            <p>{{ member.name }}</p>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-blue-500">
                                                    <path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </h4>
                                        <div class="flex space-x-8 mt-2">
                                            <div class="flex items-center space-x-2">
                                                <img
                                                    src="https://flagcdn.com/16x12/ke.png"
                                                    srcset="https://flagcdn.com/32x24/ke.png 2x,
                                                        https://flagcdn.com/48x36/ke.png 3x"
                                                    width="20"
                                                    height="14"
                                                    alt="Kenya">
                                                <p class="text-gray-500 text-sm">Republic of Kenya | {{ member.address }}</p>
                                            </div>
                                        </div>
                                        <div class="flex space-x-8 mt-2">
                                            <div class="flex items-center space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776" />
                                                </svg>
                                                <p class="text-gray-500 text-sm">{{ member.email }} | {{ member.id_number }}</p>
                                            </div>
                                        </div>
                                        <div class="flex space-x-8 mt-2">
                                            <div class="flex items-center space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.864 4.243A7.5 7.5 0 0119.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 004.5 10.5a7.464 7.464 0 01-1.15 3.993m1.989 3.559A11.209 11.209 0 008.25 10.5a3.75 3.75 0 117.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 01-3.6 9.75m6.633-4.596a18.666 18.666 0 01-2.485 5.33" />
                                                </svg>
                                                <p class="text-gray-500 text-sm">{{ member.kra_tax_number }} | Member Since {{ member.created }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-5 px-4 flex items-center space-x-4 flex-wrap">
                                        <secondary-button>Send Email</secondary-button>
                                        <secondary-button>Unverify</secondary-button>
                                        <secondary-button>
                                            <div class="flex items-center space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                                    <path fill-rule="evenodd" d="M15.75 4.5a3 3 0 11.825 2.066l-8.421 4.679a3.002 3.002 0 010 1.51l8.421 4.679a3 3 0 11-.729 1.31l-8.421-4.678a3 3 0 110-4.132l8.421-4.679a3 3 0 01-.096-.755z" clip-rule="evenodd" />
                                                </svg>
                                                <span>Share</span>
                                            </div>
                                        </secondary-button>
                                        <danger-button>Delete</danger-button>
                                    </div>
                                </div>
                                <div class="flex flex-col items-center justify-center mt-10">
                                    <CircularProgress :radius="60" :progress="86" :stroke="6" />
                                    <div class="text-center">
                                        <h4 class="text-gray-600 text-xl font-semibold mb-2">86% Credit Score</h4>
                                        <span v-if="true" class="bg-green-500 capitalize text-white shadow-md text-xs font-medium px-2.5 py-0.5 rounded">Good</span>
                                        <span v-else class="bg-gray-500 capitalize text-white shadow-md text-xs font-medium px-2.5 py-0.5 rounded">Bad</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 bg-white border border-gray-300 shadow-md">
                            <div class="px-8 py-10">
                                <div class="flex flex-col md:flex-row md:justify-between md:items-center space-y-4 md:space-y-0">
                                    <h4 class="uppercase text-gray-600 font-bold text-lg">Transactions History</h4>
                                    <form @submit.prevent="submitSearch">
                                        <div class="relative w-full">
                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                            </div>
                                            <input v-model="search.input" type="search" id="default-search" class="block w-full md:w-[400px] p-4 pl-10 text-sm text-gray-900 border bg-white focus:border-blue-400 focus:ring focus:ring-blue-300" :class="search.error ? 'border-red-500' : 'border-gray-300'" placeholder="Search By Transaction Number..." required>
                                            <button type="submit" :disabled="searchLoading" :class="{ 'opacity-75' : searchLoading }" class="text-white absolute right-2.5 bottom-2.5 bg-blue-500 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-75 transition font-medium text-sm px-4 py-2">
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
                                <div class="relative overflow-x-auto mt-5">
                                    <table class="w-full text-sm text-left text-gray-500">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">
                                                    UUID
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Account
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
                                            <template v-for="transaction in member.transactions" :key="transaction.id">
                                                <tr class="bg-white border-b hover:bg-gray-50">
                                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                                                        {{ transaction.uuid.substr(0, 7) + '...' }}
                                                    </th>
                                                    <td class="px-6 py-4">
                                                        {{ transaction.account.account_type.name }}
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
                                    <div v-if="!member.transactions.length" class="bg-white w-full flex">
                                        <div class="w-full py-4"><p class="text-xs italic text-center">No Data Found</p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-4">
                        <div class="mt-6 bg-white border border-gray-300 shadow-md">
                            <div>
                                <div class="flex justify-between items-center bg-white px-8 py-5 border-b-2 border-gray-300">
                                    <h4 class="text-gray-600 font-semibold text-lg">Accounts</h4>
                                    <div class="inline-flex items-center justify-center w-8 h-8 text-sm font-bold text-blue-500 bg-blue-200 border-2 border-white rounded-full">{{ member.accounts.length }}</div>
                                </div>
                                <div class="px-8 pt-5">
                                    <template v-for="account in member.accounts" :key="account.uuid">
                                        <div class="my-4 border-b border-gray-200 last:border-0 pb-3">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h4 class="font-semibold text-gray-500">{{ account.account_type.name }}</h4>
                                                    <p class="text-sm text-gray-500 mt-1">{{ NumberFormat.format(account.available_balance) }}</p>
                                                </div>
                                                <div class="mt-2">
                                                    <span v-if="account.status == 'active'" class="bg-green-500 capitalize text-white shadow-md text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ account.status }}</span>
                                                    <span v-else class="bg-gray-500 capitalize text-white shadow-md text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ account.status }}</span>
                                                </div>
                                            </div>
                                            <div class="mt-3 flex items-center justify-end space-x-2">
                                                <TooltipMin v-if="account.status == 'active'" class="hover:bg-gray-100 duration-200 rounded-lg px-2 py-2 flex justify-center items-center">
                                                    <template #button>
                                                        <button @click="freezeAccount(account.uuid)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-600">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.412 15.655L9.75 21.75l3.745-4.012M9.257 13.5H3.75l2.659-2.849m2.048-2.194L14.25 2.25 12 10.5h8.25l-4.707 5.043M8.457 8.457L3 3m5.457 5.457l7.086 7.086m0 0L21 21" />
                                                            </svg>
                                                        </button>
                                                    </template>
                                                    <template #body>
                                                        <div class="text-gray-500">Freeze</div>
                                                    </template>
                                                </TooltipMin>
                                                <TooltipMin v-else class="hover:bg-gray-100 duration-200 rounded-lg px-2 py-2 flex justify-center items-center">
                                                    <template #button>
                                                        <button @click="activateAccount(account.uuid)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-600">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                                                            </svg>
                                                        </button>
                                                    </template>
                                                    <template #body>
                                                        <div class="text-gray-500">Activate</div>
                                                    </template>
                                                </TooltipMin>
                                                <TooltipMin class="hover:bg-gray-100 duration-200 rounded-lg px-2 py-2 flex justify-center items-center">
                                                    <template #button>
                                                        <button @click="activateAccount(account.uuid)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-600">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                                            </svg>
                                                        </button>
                                                    </template>
                                                    <template #body>
                                                        <div class="text-gray-500">Transactions</div>
                                                    </template>
                                                </TooltipMin>
                                            </div>
                                        </div>
                                    </template>
                                    <div v-if="!member.accounts.length" class="grid items-center justify-center pb-10">
                                        <div class="flex flex-col items-center justify-center">
                                            <img src="../../../../img/no-accounts-doodle.svg" alt="No Account Doodle" class="w-60 object-contain">
                                            <div class="mt-6 flex flex-col items-center justify-center">
                                                <p class="text-gray-600 text-center">There are no accounts currently associated with this user. Would you like to create one?</p>
                                                <secondary-button class="mt-4">Open Account</secondary-button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 bg-white border border-gray-300 shadow-md">
                            <div>
                                <div class="flex justify-between items-center bg-white px-8 py-5 border-b-2 border-gray-300">
                                    <h4 class="text-gray-600 font-semibold text-lg">Loans</h4>
                                    <div class="inline-flex items-center justify-center w-8 h-8 text-sm font-bold text-blue-500 bg-blue-200 border-2 border-white rounded-full">{{ loans.length }}</div>
                                </div>
                                <div class="px-8 pt-5">
                                    <template v-for="loan in loans" :key="loan.uuid">
                                        <div class="my-4 border-b border-gray-200 last:border-0 pb-3">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h4 class="font-semibold text-gray-500">{{ loan.loan.loan_type }}</h4>
                                                    <p class="text-sm text-gray-500">{{ NumberFormat.format(loan.amount_payable) }}</p>
                                                    <div class="text-xs mt-3">
                                                        <p class="text-gray-500">{{ loan.plan.name }}</p>
                                                        <p class="text-gray-500">Repayment in <span class="font-bold text-blue-500">{{ loan.plan.repayment_months }} months</span> at <span class="font-bold text-blue-500">{{ loan.plan.interest_rate }}%</span> - interest</p>
                                                        <p class="text-gray-500">Penalty rate @<span class="font-bold text-blue-500">{{ loan.plan.penalty_rate }}%</span></p>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <span v-if="loan.status == 'pending'" class="px-2 py-1 rounded-md shadow-md bg-gray-500 text-white uppercase text-xs font-bold">
                                                        {{ loan.status }}
                                                    </span>
                                                    <span v-if="loan.status == 'approved'" class="px-2 py-1 rounded-md shadow-md bg-green-500 text-white uppercase text-xs font-bold">
                                                        {{ loan.status }}
                                                    </span>
                                                    <span v-if="loan.status == 'rejected'" class="px-2 py-1 rounded-md shadow-md bg-red-500 text-white uppercase text-xs font-bold">
                                                        {{ loan.status }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="mt-3 flex items-center justify-end space-x-2">
                                                <TooltipMin v-if="loan.status == 'pending'" class="hover:bg-gray-100 duration-200 rounded-lg px-2 py-2 flex justify-center items-center">
                                                    <template #button>
                                                        <button @click="approveLoan(loan.uuid)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-600">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                                                            </svg>
                                                        </button>
                                                    </template>
                                                    <template #body>
                                                        <div class="text-gray-500">Approve</div>
                                                    </template>
                                                </TooltipMin>
                                                <TooltipMin v-if="loan.status == 'pending'" class="hover:bg-gray-100 duration-200 rounded-lg px-2 py-2 flex justify-center items-center">
                                                    <template #button>
                                                        <button @click="rejectLoan(loan.uuid)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-600">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 15h2.25m8.024-9.75c.011.05.028.1.052.148.591 1.2.924 2.55.924 3.977a8.96 8.96 0 01-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398C20.613 14.547 19.833 15 19 15h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 00.303-.54m.023-8.25H16.48a4.5 4.5 0 01-1.423-.23l-3.114-1.04a4.5 4.5 0 00-1.423-.23H6.504c-.618 0-1.217.247-1.605.729A11.95 11.95 0 002.25 12c0 .434.023.863.068 1.285C2.427 14.306 3.346 15 4.372 15h3.126c.618 0 .991.724.725 1.282A7.471 7.471 0 007.5 19.5a2.25 2.25 0 002.25 2.25.75.75 0 00.75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 002.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384" />
                                                            </svg>
                                                        </button>
                                                    </template>
                                                    <template #body>
                                                        <div class="text-gray-500">Reject</div>
                                                    </template>
                                                </TooltipMin>
                                                <TooltipMin class="hover:bg-gray-100 duration-200 rounded-lg px-2 py-2 flex justify-center items-center">
                                                    <template #button>
                                                        <button @click="activateAccount(account.uuid)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-600">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                                            </svg>
                                                        </button>
                                                    </template>
                                                    <template #body>
                                                        <div class="text-gray-500">Transactions</div>
                                                    </template>
                                                </TooltipMin>
                                            </div>
                                        </div>
                                    </template>
                                    <div v-if="!member.accounts.length" class="grid items-center justify-center pb-10">
                                        <div class="flex flex-col items-center justify-center">
                                            <img src="../../../../img/no-loan-doodle.svg" alt="No Loans Doodle" class="w-60 object-contain">
                                            <div class="mt-6 flex flex-col items-center justify-center">
                                                <p class="text-gray-600 text-center">There are no loans currently associated with this user. Would you like to create one?</p>
                                                <secondary-button class="mt-4">Apply Loan</secondary-button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>