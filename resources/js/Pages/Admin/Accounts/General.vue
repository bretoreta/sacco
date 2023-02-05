<script setup>
import { router, usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TooltipMin from '@/Components/TooltipMin.vue';
import Pagination from '@/Components/Pagination.vue';

const pageprops = defineProps({
    accounts: Object,
});

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

const deleteAccount = (id) => {
    if(confirm("Are you sure to delete this account? All it's resources will be deleted!"))
    {
        router.delete(route('admin.accounts.delete', id),
        { 
            preserveScroll:true,
            onSuccess: () => {
                bannerTimeout()
            }
        })
    }
}

const bannerTimeout = () => {
    setTimeout(() => {
        usePage().props.flash.message = null
    }, 4000)
}
</script>

<template>
    <AdminLayout title="Manage General Accounts">
        <div class="py-6 md:py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-12 gap-5 px-4">
                    <div class="col-span-12">
                        <div class="p-5 text-lg sm:rounded-t-xl font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                            Manage General Accounts
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
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
                                        <th scope="col" class="px-6 py-3">
                                            Actions
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
                                            <td class="px-6 py-4">
                                                <div class="flex items-center justify-center space-x-3">
                                                    <TooltipMin v-if="account.status == 'active'">
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
                                                    <TooltipMin v-else>
                                                        <template #button>
                                                            <button @click="activateAccount(account.uuid)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-900">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                                                                </svg>
                                                            </button>
                                                        </template>
                                                        <template #body>
                                                            <div class="text-gray-500">Activate</div>
                                                        </template>
                                                    </TooltipMin>
                                                    <TooltipMin>
                                                        <template #button>
                                                            <button @click="deleteAccount(account.uuid)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-6 h-6 text-red-500">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                </svg>
                                                            </button>
                                                        </template>
                                                        <template #body>
                                                            <div class="text-gray-500">Delete</div>
                                                        </template>
                                                    </TooltipMin>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                            <div v-if="!accounts.data.length" class="bg-white w-full flex">
                                <div class="w-full py-4"><p class="text-xs italic text-center">No Data Found</p></div>
                            </div>
                        </div>
                        <Pagination v-if="accounts.data.length" :data="accounts" />
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>