<script setup>
import { ref } from 'vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TooltipMin from '@/Components/TooltipMin.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import Pagination from '@/Components/Pagination.vue';
import DialogModal from '@/Components/DialogModal.vue';
import Multiselect from '@suadelabs/vue3-multiselect';

const pageprops = defineProps({
    meetings: Object,
    meeting_types: Object,
});

const form = useForm({
    id: '',
    meeting_type: '',
    agenda: '',
    venue: '',
    is_invite_only: false,
    happening_on: '',
});

const editingMeeting = ref(false);

const editMeeting = (meeting) => {
    form.id = meeting.id;
    form.meeting_type = meeting.meeting_type;
    form.agenda = meeting.agenda;
    form.venue = meeting.venue;
    form.is_invite_only = meeting.is_invite_only;
    form.happening_on = meeting.happening_on;

    editingMeeting.value = true;
}

const submit = () => {
    form.put(route('admin.meetings.update', form.id), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset(),
            editingMeeting.value = false,
            bannerTimeout()
        }
    })
}

const deleteMeeting = (id) => {
    if(confirm("Are you sure to delete this meeting? All it's resources will be deleted!"))
    {
        router.delete(route('admin.meetings.delete', id),
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
    <AdminLayout title="Manage Meetings">
        <div class="py-6 md:py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-12 gap-5 px-4">
                    <div class="col-span-12">
                        <div class="p-5 text-lg sm:rounded-t-xl font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                            Manage Meetings
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
                                        <th scope="col" class="px-6 py-3">
                                            Actions
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
                                            <td class="px-6 py-4">
                                                <div class="flex items-center justify-center space-x-3">
                                                    <TooltipMin>
                                                        <template #button>
                                                            <button @click="editMeeting(meeting)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-6 h-6 text-gray-600">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                                </svg>
                                                            </button>
                                                        </template>
                                                        <template #body>
                                                            <div class="text-gray-500">Edit</div>
                                                        </template>
                                                    </TooltipMin>
                                                    <TooltipMin>
                                                        <template #button>
                                                            <button @click="deleteMeeting(meeting.id)">
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
                            <div v-if="!meetings.data.length" class="bg-white w-full flex">
                                <div class="w-full py-4"><p class="text-xs italic text-center">No Data Found</p></div>
                            </div>
                        </div>
                        <Pagination v-if="meetings.data.length" :data="meetings" />
                    </div>
                </div>
                <DialogModal :show="editingMeeting" @close="editingMeeting = false">
                    <template #title>
                        Edit Meeting
                    </template>

                    <template #content>
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
                                        <Checkbox id="is_invite_only" v-model:checked="form.is_invite_only" name="is_invite_only" />

                                        <div class="ml-2">
                                            Invite Only?
                                        </div>
                                    </div>
                                    <InputError class="mt-2" :message="form.errors.is_invite_only" />
                                </InputLabel>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton class="ml-4" :class="{ 'opacity-75': form.processing }" :disabled="form.processing">
                                    Update Meeting
                                </PrimaryButton>
                            </div>
                        </form>
                    </template>
                </DialogModal>
            </div>
        </div>
    </AdminLayout>
</template>
<style src="@suadelabs/vue3-multiselect/dist/vue3-multiselect.css"></style>