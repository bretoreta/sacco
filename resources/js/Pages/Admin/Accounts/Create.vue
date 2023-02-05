<script setup>
import { reactive, ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { router } from "@inertiajs/vue3";
import AdminLayout from '@/Layouts/AdminLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TooltipMin from '@/Components/TooltipMin.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import Pagination from '@/Components/Pagination.vue';
import DialogModal from '@/Components/DialogModal.vue';
import Multiselect from '@suadelabs/vue3-multiselect'

defineProps({
    users: Object,
    account_types: Object,
    all_count: Number,
    general_count: Number,
    savings_count: Number,
    contributions_count: Number,
})

const form = useForm({
    user: '',
    account_type: '',
});

const bannerTimeout = () => {
    setTimeout(() => {
        usePage().props.flash.message = null
    }, 4000)
}

const submit = () => {
    form.post(route('admin.accounts.store'), {
        onSuccess: () => {
            form.reset(),
            bannerTimeout()
        }
    })
}
</script>

<template>
    <AdminLayout title="Open Account">
        <div class="py-6 md:py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-12 gap-5 px-4">
                    <div class="col-span-12 md:col-span-8 ">
                        <div class="bg-white rounded-md shadow-md border border-gray-300">
                            <div class="p-5 text-lg sm:rounded-t-md font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                Open Account
                                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
                            </div>
                            <form @submit.prevent="submit" class="mt-6 px-8 pb-8">
                                <div>
                                    <InputLabel for="user" value="Account Holder" />
                                    <multiselect
                                        v-model="form.user"
                                        :options="users"
                                        :close-on-select="true"
                                        :clear-on-select="false"
                                        label="name"
                                        track-by="name"
                                        >
                                    </multiselect>
                                    <InputError class="mt-2" :message="form.errors.user" />
                                </div>

                                <div class="mt-4">
                                    <InputLabel for="account_type" value="Account Type" />
                                    <multiselect
                                        v-model="form.account_type"
                                        :options="account_types"
                                        :close-on-select="true"
                                        :clear-on-select="false"
                                        label="name"
                                        track-by="name"
                                        >
                                    </multiselect>
                                    <InputError class="mt-2" :message="form.errors.account_type" />
                                </div>

                                <div class="flex justify-end mt-4 w-full">
                                    <PrimaryButton :class="{ 'opacity-75': form.processing }" :disabled="form.processing">
                                        Open Account
                                    </PrimaryButton>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-4">
                        <div class="bg-white rounded-lg shadow-md border border-gray-300 p-6">
                            <div class="text-lg font-bold text-left text-gray-900 bg-white">
                                Opened Accounts Overview
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
                                                All Accounts
                                            </span>
                                            <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-gray-400 group-hover:bg-blue-500 rounded-full">{{ all_count }}</span>
                                        </span>
                                    </button>
                                    <button type="button" class="relative group inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                        <span class="flex items-center justify-between w-full">
                                            <span class="inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                                General Accounts
                                            </span>
                                            <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-gray-400 group-hover:bg-blue-500 rounded-full">{{ general_count }}</span>
                                        </span>
                                    </button>
                                    <button type="button" class="relative group inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                        <span class="flex items-center justify-between w-full">
                                            <span class="inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                                </svg>
                                                Savings Accounts
                                            </span>
                                            <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-gray-400 group-hover:bg-blue-500 rounded-full">{{ savings_count }}</span>
                                        </span>
                                    </button>
                                    <button type="button" class="relative group inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                        <span class="flex items-center justify-between w-full">
                                            <span class="inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Contribution Accounts
                                            </span>
                                            <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-gray-400 group-hover:bg-blue-500 rounded-full">{{ contributions_count }}</span>
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