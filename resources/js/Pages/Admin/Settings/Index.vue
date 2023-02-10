<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const pageprops = defineProps({
    settings: Object,
});

const form = useForm({

})

const bannerTimeout = () => {
    setTimeout(() => {
        usePage().props.flash.message = null
    }, 4000)
}
</script>

<template>
    <AdminLayout title="Overview Settings">
        <div class="py-6 md:py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center justify-between px-4 md:px-0">
                    <h4 class="text-3xl text-gray-600 font-bold mb-10">Manage Settings</h4>
                </div>
                <div class="grid grid-cols-12 gap-5 px-4">
                    <div class="col-span-12 md:col-span-6">
                        <div class="bg-white shadow-md rounded-md border-border-gray-300">
                            <template v-for="(item, index ) in settings.data" :key="index">
                                <div class="mb-4 last:mb-0">
                                    <div class="w-full bg-gray-500 px-6 py-2">
                                        <p class="uppercase text-white font-bold text-sm">{{ index }}</p>
                                    </div>
                                    <div class="p-6">
                                        <div class="flex flex-col space-y-4">
                                            <template v-for="(option, index) in item" :key="index">
                                                <label v-if="(typeof option === 'boolean')" class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" value="" class="sr-only peer" :checked="option">
                                                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                                    <span class="ml-3 text-sm font-medium text-gray-900 capitalize">{{ index.replace(/_/g, " ") }}</span>
                                                </label>
                                                <div v-else>
                                                    <InputLabel for="loan_type" :value="index.replace(/_/g, ' ')" class="capitalize mt-2" />
                                                    <TextInput
                                                        id="loan_type"
                                                        v-model="form.loan_type"
                                                        type="text"
                                                        :value="option"
                                                        class="mt-1 block w-full"
                                                        required
                                                        autofocus
                                                    />
                                                    <InputError class="mt-2" :message="form.errors.loan_type" />
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>