<script setup>
import { ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import Multiselect from '@suadelabs/vue3-multiselect';

const pageprops = defineProps({
    meeting_types: Object,
    all_count: Number,
    pending_count: Number,
    past_count: Number,
})

const form = useForm({
    meeting_type: '',
    agenda: '',
    venue: '',
    is_invite_only: false,
    happening_on: '',
});

const bannerTimeout = () => {
    setTimeout(() => {
        usePage().props.flash.message = null
    }, 4000)
}

const submit = () => {
    form.post(route('admin.meetings.store'), {
        onSuccess: () => {
            form.reset(),
            bannerTimeout()
        }
    })
}
</script>

<template>
    <AdminLayout title="Schedule Meeting">
        <div class="py-6 md:py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-12 gap-5 px-4">
                    <div class="col-span-12 md:col-span-8 ">
                        <div class="bg-white rounded-md shadow-md border border-gray-300">
                            <div class="p-5 text-lg sm:rounded-t-md font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                Schedule Meeting
                                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
                            </div>
                            <div class="p-4 md:p-10">
                                <form @submit.prevent="submit">
                                    <div>
                                        <InputLabel for="meeting_type" value="Meeting Type" />
                                        <multiselect
                                            v-model="form.meeting_type"
                                            :options="meeting_types"
                                            :close-on-select="true"
                                            :clear-on-select="false"
                                            label="name"
                                            track-by="name"
                                            >
                                        </multiselect>
                                        <InputError class="mt-2" :message="form.errors.meeting_type" />
                                    </div>

                                    <div class="mt-4">
                                        <InputLabel for="agenda" value="Agenda" />
                                        <TextInput
                                            id="agenda"
                                            v-model="form.agenda"
                                            type="text"
                                            class="mt-1 block w-full"
                                            required
                                        />
                                        <InputError class="mt-2" :message="form.errors.agenda" />
                                    </div>

                                    <div class="grid grid-cols-2 mt-4 gap-3">
                                        <div class="col-span-2 md:col-span-1">
                                            <InputLabel for="venue" value="Venue" />
                                            <TextInput
                                                id="venue"
                                                v-model="form.venue"
                                                type="text"
                                                class="mt-1 block w-full"
                                                required
                                                autocomplete="venue"
                                            />
                                            <InputError class="mt-2" :message="form.errors.venue" />
                                        </div>
                                        <div class="col-span-2 md:col-span-1">
                                            <InputLabel for="happening_on" value="Date Happening" />
                                            <TextInput
                                                id="happening_on"
                                                v-model="form.happening_on"
                                                type="date"
                                                class="mt-1 block w-full"
                                                required
                                                autocomplete="happening_on"
                                            />
                                            <InputError class="mt-2" :message="form.errors.happening_on" />
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <InputLabel for="is_invite_only">
                                            <div class="flex items-center">
                                                <Checkbox id="is_invite_only" v-model:checked="form.is_invite_only" name="is_invite_only" required />

                                                <div class="ml-2">
                                                    Invite Only?
                                                </div>
                                            </div>
                                            <InputError class="mt-2" :message="form.errors.is_invite_only" />
                                        </InputLabel>
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <PrimaryButton class="ml-4" :class="{ 'opacity-75': form.processing }" :disabled="form.processing">
                                            Create Meeting
                                        </PrimaryButton>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-4">
                        <div class="bg-white rounded-lg shadow-md border border-gray-300 p-6">
                            <div class="text-lg font-bold text-left text-gray-900 bg-white">
                                Meetings Overview
                                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play.</p>
                            </div>
                            <div class="mt-5">                               
                                <div class="text-gray-900 bg-white border border-gray-200 rounded-lg">
                                    <button type="button" class="relative group inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                        <span class="flex items-center justify-between w-full">
                                            <span class="inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                                </svg>
                                                All Meetings
                                            </span>
                                            <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-gray-400 group-hover:bg-blue-500 rounded-full">{{ all_count }}</span>
                                        </span>
                                    </button>
                                    <button type="button" class="relative group inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                        <span class="flex items-center justify-between w-full">
                                            <span class="inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                                </svg>
                                                Upcoming Meetings
                                            </span>
                                            <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-gray-400 group-hover:bg-blue-500 rounded-full">{{ pending_count }}</span>
                                        </span>
                                    </button>
                                    <button type="button" class="relative group inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                        <span class="flex items-center justify-between w-full">
                                            <span class="inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
                                                </svg>
                                                Past Meetings
                                            </span>
                                            <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-gray-400 group-hover:bg-blue-500 rounded-full">{{ past_count }}</span>
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
<style src="@suadelabs/vue3-multiselect/dist/vue3-multiselect.css"></style>