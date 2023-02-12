<script setup>
import { ref } from 'vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import FiltersDropdown from '@/Components/FiltersDropdown.vue';
import Accordion from "@/components/Accordion.vue";
import AccordionItem from "@/components/AccordionItem.vue";
import Pagination from '@/Components/Pagination.vue';

const pageprops = defineProps({
    members: Object,
});

const form = useForm({
    id: '',
    name: '',
    email: '',
    id_number: '',
    phone_number: '',
    kra_tax_number: '',
    address: '',
});

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
                        <div class="pb-20 flex justify-between">
                            <h4 class="text-3xl">Generate Transactions Report</h4>
                            <div>
                                <FiltersDropdown :width="'60'">
                                    <template #trigger>
                                        <button
                                            class="bg-white px-4 py-2 shadow-sm text-gray-600 rounded-md border border-gray-300 inline-flex justify-between items-center space-x-4 hover:bg-gray-50 active:bg-blue-100 focus:outline-none focus:border-blue-400 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                                            <p>Filters</p>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                                            </svg>
                                        </button>
                                    </template>
                                    <template #content>
                                        <div class="p-5 w-full">
                                            <div class="flex w-full items-center justify-between">
                                                <p class="text-gray-700 font-bold">Filters</p>
                                                <button class="text-blue-500 text-xs font-semibold">Clear All</button>
                                            </div>
                                            <div>
                                                <accordion>
                                                    <accordion-item>
                                                        <!-- This slot will handle the title/header of the accordion and is the part you click on -->
                                                        <template slot="accordion-trigger">
                                                            <h3>Item 1</h3>
                                                        </template>
                                                        <!-- This slot will handle all the content that is passed to the accordion -->
                                                        <template slot="accordion-content">
                                                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                                elit, sed do eiusmod tempor incididunt ut labore et
                                                                dolore magna aliqua. Ut enim ad minim veniam, quis
                                                                nostrud exercitation ullamco laboris nisi ut aliquip ex
                                                                ea commodo consequat.</span>
                                                        </template>
                                                    </accordion-item>

                                                    <accordion-item>
                                                        <!-- This slot will handle the title/header of the accordion and is the part you click on -->
                                                        <template slot="accordion-trigger">
                                                            <h3>Item 2</h3>
                                                        </template>
                                                        <!-- This slot will handle all the content that is passed to the accordion -->
                                                        <template slot="accordion-content">
                                                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                                elit, sed do eiusmod tempor incididunt ut labore et
                                                                dolore magna aliqua. Ut enim ad minim veniam, quis
                                                                nostrud exercitation ullamco laboris nisi ut aliquip ex
                                                                ea commodo consequat.</span>
                                                        </template>
                                                    </accordion-item>

                                                    <accordion-item>
                                                        <!-- This slot will handle the title/header of the accordion and is the part you click on -->
                                                        <template slot="accordion-trigger">
                                                            <h3>Item 3</h3>
                                                        </template>
                                                        <!-- This slot will handle all the content that is passed to the accordion -->
                                                        <template slot="accordion-content">
                                                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                                elit, sed do eiusmod tempor incididunt ut labore et
                                                                dolore magna aliqua. Ut enim ad minim veniam, quis
                                                                nostrud exercitation ullamco laboris nisi ut aliquip ex
                                                                ea commodo consequat.</span>
                                                        </template>
                                                    </accordion-item>
                                                </accordion>
                                            </div>
                                        </div>
                                    </template>
                                </FiltersDropdown>
                            </div>
                        </div>
                        <div
                            class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                            Transactions Report
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of
                                Flowbite products designed to help you work and play, stay organized, get answers, keep
                                in touch, grow your business, and more.</p>
                        </div>
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Identity
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Address
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Phone Number
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Member Since
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <!-- <div v-if="!members.data.length" class="bg-white w-full flex">
                                <div class="w-full py-4"><p class="text-xs italic text-center">No Data Found</p></div>
                            </div> -->
                        </div>
                        <!-- <Pagination v-if="members.data.length" :data="members" /> -->
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>