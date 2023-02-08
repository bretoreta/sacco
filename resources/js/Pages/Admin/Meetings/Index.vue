<script setup>
import { usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const pageprops = defineProps({
    meetings: Object,
    all_count: Number,
    pending_count: Number,
    past_count: Number,
});

const bannerTimeout = () => {
    setTimeout(() => {
        usePage().props.flash.message = null
    }, 4000)
}
</script>

<template>
    <AdminLayout title="Overview Meetings">
        <div class="py-6 md:py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-12 gap-5 px-4">
                    <div class="col-span-12 my-5">
                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-1">
                                <div class="bg-blue-500 rounded-lg shadow-md border border-blue-300 p-6">
                                    <p class="text-white font-bold text-sm uppercase">All Meetings</p>
                                    <div class="mt-5">
                                        <h4 class="text-4xl font-bold text-blue-200">{{ all_count }} <span class="text-blue-300 text-xs">Users In Total</span></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="bg-blue-500 rounded-lg shadow-md border border-blue-300 p-6">
                                    <p class="text-white font-bold text-sm uppercase">Meetings Past</p>
                                    <div class="mt-5">
                                        <h4 class="text-4xl font-bold text-blue-200">{{ past_count }} <span class="text-blue-300 text-xs">Users In Total</span></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="bg-blue-500 rounded-lg shadow-md border border-blue-300 p-6">
                                    <p class="text-white font-bold text-sm uppercase">Upcoming Meetings</p>
                                    <div class="mt-5">
                                        <h4 class="text-4xl font-bold text-blue-200">{{ pending_count }} <span class="text-blue-300 text-xs">Users In Total</span></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <div class="p-5 text-lg sm:rounded-t-xl font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                            Recently Scheduled Meetings
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
                        </div>
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Meeting Type
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Agenda
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Venue
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Invite Only
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="meeting in meetings.data" :key="meeting.id">
                                        <tr class="bg-white border-b hover:bg-gray-50">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                                                {{ meeting.meeting_type.name }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ meeting.agenda }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ meeting.venue }}
                                            </td>
                                            <td class="px-6 py-4 uppercase">
                                                <button v-if="meeting.is_invite_only" class="px-2 py-1 rounded-md shadow-md bg-green-500 text-white uppercase text-xs font-bold">
                                                    Invite Only
                                                </button>
                                                <button v-else class="px-2 py-1 rounded-md shadow-md bg-gray-500 text-white uppercase text-xs font-bold">
                                                    Unrestricted
                                                </button>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ meeting.created }}
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                            <div v-if="!meetings.data.length" class="bg-white w-full flex">
                                <div class="w-full py-4"><p class="text-xs italic text-center">No Data Found</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>