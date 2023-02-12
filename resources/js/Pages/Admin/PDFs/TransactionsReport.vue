<script setup>
import { ref } from 'vue';
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
</script>

<template>
    <AdminLayout title="Transactions Report">
        <div class="py-6 md:py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-12 gap-5 px-4">
                    <div class="col-span-12">
                        <div class="pb-10">
                            <h4 class="text-3xl">Transactions Report</h4>
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