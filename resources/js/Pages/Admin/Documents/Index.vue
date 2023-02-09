<script setup>
import { ref } from '@vue/reactivity';
import { router, useForm, usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TooltipMin from '@/Components/TooltipMin.vue';
import DialogModal from '@/Components/DialogModal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import axios from 'axios';

const pageprops = defineProps({
    documents: Object,
});

const uploadingFile = ref(false);
const dragging = ref(false);
const media = ref([]);
const files = ref(null);

const form = useForm({
    file: null,
});

const deleteDocument = (id) => {
    if(confirm("Are you sure to delete this document? All it's resources will be deleted!"))
    {
        router.delete(route('admin.documents.delete', id),
        { 
            preserveScroll:true,
            onSuccess: () => {
                bannerTimeout()
            }
        })
    }
}

const handleUpload = ($event) => {
    dragging.value = false;
    let files = [...$event.dataTransfer.items].filter(item => item.kind === 'file').map(item => item.getAsFile());

    uploadFiles(files);
}

const inputChange = ($event) => {
    let files = [...$event.target.files];
    uploadFiles(files);
    document.getElementById('dropzone-file').value = null
}

const uploadFiles = (files) => {
    files.forEach(file => {
        media.value.unshift({
            file: file,
            progress: 0,
            error: null,
            uploaded: false,
        });
    });

    media.value.filter(media => !media.uploaded).forEach(media => {
        let form = new FormData;

        form.append('file', media.file);

        axios.post(route('admin.docs.store'), form, {
            onUploadProgress: (event) => {
                media.progress = Math.round(event.loaded * 100/event.total);
            }
        })
        .then(() => media.uploaded = true)
        .catch(error => {
            media.error = 'Upload Failed. Please Try Again Later.'

            if(error?.response.status === 422)
            {
                media.error = error.response.data.errors.file[0];
            }
        });
    });
}

const bannerTimeout = () => {
    setTimeout(() => {
        usePage().props.flash.message = null
    }, 4000)
}
</script>

<template>
    <AdminLayout title="Overview Documents">
        <div class="py-6 md:py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center justify-between px-4 md:px-0">
                    <h4 class="text-3xl text-gray-600 font-bold mb-10">Manage Documents</h4>
                    <button @click="uploadingFile = true" class="px-4 py-2 bg-blue-500 rounded-md uppercase shadow-md text-white text-sm font-bold inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                        </svg>
                        Upload
                    </button>
                </div>
                <div class="grid grid-cols-12 gap-5 px-4">
                    <template v-for="document in documents.data" :key="document.id">
                        <div class="col-span-3">
                            <div class="bg-white rounded-lg shadow border border-gray-300">
                                <div class="rounded-lg p-14 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                                    </svg>
                                </div>
                                <div class="p-5 bg-gray-50">
                                    <div class="block">
                                        <p class="text-gray-800 uppercase text-sm font-bold">{{ document.display_name }}</p>
                                        <div class="py-2 flex items-center justify-between">
                                            <div class="flrx space-x-2">
                                                <button class="bg-blue-500 rounded shadow-md text-white text-xs font-bold px-2 py-1">{{ document.docsize }}</button>
                                                <button class="bg-gray-500 rounded shadow-md text-white text-xs font-bold px-2 py-1">{{ document.doctype }}</button>
                                            </div>
                                            <div>
                                                <TooltipMin>
                                                    <template #button>
                                                        <button @click="deleteDocument(document.id)">
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
                                        </div>
                                    </div>
                                    <div class="block mt-2">
                                        <p class="text-xs italic font-bold text-gray-500">Uploaded By: {{ document.user.name }} on {{ document.created }}</p>
                                        <!-- <p class="text-xs italic font-bold text-gray-500 mt-1">{{ document.url}}</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                    <div v-if="documents.next_page_url" class="col-span-12">
                        <div class="flex w-full justify-center">
                            <button class="px-4 py-2 bg-white rounded-md shadow-md border border-gray-300 text-gray-800 text-sm font-bold">Load More</button>
                        </div>
                    </div>
                </div>
            </div>
            <DialogModal :show="uploadingFile" @close="uploadingFile = false">
                <template #title>
                    Upload FIle
                </template>

                <template #content>
                    <form @submit.prevent="submit">
                        <div>                         
                            <div class="flex items-center justify-center w-full">
                                <label @drop.prevent="handleUpload" @dragover.prevent="dragging = true" @dragleave.prevent="dragging = false" for="dropzone-file" :class="dragging ? 'border-blue-500' : 'border-gray-300'" class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500">Upload Any File (MAX. 100MBs)</p>
                                    </div>
                                    <input @change="inputChange" id="dropzone-file" type="file" name="files" ref="files" multiple="true" class="hidden" />
                                </label>
                            </div> 
                        </div>
                        
                        <div class="mt-4" v-if="media.length">
                            <div class=" bg-gray-100 rounded-md p-5">
                                <ul class="divide-y divide-gray-300">
                                    <template v-for="(item, index) in media" :key="index">
                                        <li class="flex items-center justify-between p-3 mt-2 first:mb-0">
                                            <p class="text-sm text-gray-700">{{ item.file.name }}</p>
                                            <p :class="!item.uploaded ? 'text-blue-500' : 'text-green-500'" v-if="!item.error" class="whitespace-nowrap text-xs font-bold">{{ !item.uploaded ? 'Uploading...' : 'Uploaded' }}</p>
                                            <InputError :message="item.error" />
                                        </li>
                                        <div v-if="!item.uploaded && !item.error" class="w-full bg-gray-200 shadow-inner rounded-full">
                                            <div :class="item.progress < 100 ? 'bg-blue-500' : 'bg-green-500'" class="text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" :style="`width: ${item.progress}%`"> {{ item.progress }} %</div>
                                        </div>
                                    </template>
                                </ul>
                            </div>
                        </div>
                    </form>
                </template>
            </DialogModal>
        </div>
    </AdminLayout>
</template>