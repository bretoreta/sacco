<script setup>
import { onBeforeMount, reactive, ref } from 'vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TooltipMin from '@/Components/TooltipMin.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import Pagination from '@/Components/Pagination.vue';
import DialogModal from '@/Components/DialogModal.vue';

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

const editingMember = ref(false);

const editMember = (member) => {
    form.id = member.id;
    form.name = member.name;
    form.email = member.email;
    form.id_number = member.id_number;
    form.phone_number = member.phone_number;
    form.kra_tax_number = member.kra_tax_number;
    form.address = member.address;

    editingMember.value = true;
}

const submit = () => {
    form.put(route('admin.members.update', form.id), {
        onSuccess: () => {
            form.reset(),
            editingMember.value = false,
            bannerTimeout()
        }
    })
}

const verifyUser = (id) => {
    router.post(route('admin.members.verify', id), {} , {
        onSuccess: () => {
            bannerTimeout()
        }
    })
}

const unverifyUser = (id) => {
    router.post(route('admin.members.unverify', id), {} , {
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
    <AdminLayout title="Transactions Members">
        <div class="py-6 md:py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-12 gap-5 px-4">
                    <div class="col-span-12">
                        <div class="p-5 text-lg sm:rounded-t-xl font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                            Browse Members
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
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
                                    <template v-for="member in members.data" :key="member.id">
                                        <tr class="bg-white border-b hover:bg-gray-50">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                                                <div>
                                                    <p class="font-bold">{{ member.name }}</p>
                                                    <p>ID - {{ member.id_number }}</p>
                                                    <p>Phone - {{ member.kra_tax_number ?? 'N/A' }}</p>
                                                </div>
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ member.address }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ member.phone_number }}
                                            </td>
                                            <td class="px-6 py-4 uppercase">
                                                <button v-if="member.email_verified_at" class="px-2 py-1 rounded-md shadow-md bg-green-500 text-white uppercase text-xs font-bold">
                                                    Verified
                                                </button>
                                                <button v-else class="px-2 py-1 rounded-md shadow-md bg-gray-500 text-white uppercase text-xs font-bold">
                                                    UnVerified
                                                </button>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ member.created }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center justify-center space-x-3">
                                                    <TooltipMin v-if="member.email_verified_at">
                                                        <template #button>
                                                            <button @click="unverifyUser(member.id)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-600">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25v13.5m-7.5-13.5v13.5" />
                                                                </svg>
                                                            </button>
                                                        </template>
                                                        <template #body>
                                                            <div class="text-gray-500">UnVerify</div>
                                                        </template>
                                                    </TooltipMin>
                                                    <TooltipMin v-else>
                                                        <template #button>
                                                            <button @click="verifyUser(member.id)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-600">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                                </svg>
                                                            </button>
                                                        </template>
                                                        <template #body>
                                                            <div class="text-gray-500">Verify</div>
                                                        </template>
                                                    </TooltipMin>
                                                    <TooltipMin>
                                                        <template #button>
                                                            <button @click="editMember(member)">
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
                                                            <button @click="deleteLoanType(member.id)">
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
                            <div v-if="!members.data.length" class="bg-white w-full flex">
                                <div class="w-full py-4"><p class="text-xs italic text-center">No Data Found</p></div>
                            </div>
                        </div>
                        <Pagination v-if="members.data.length" :data="members" />
                    </div>
                </div>
                <DialogModal :show="editingMember" @close="editingMember = false">
                    <template #title>
                        Edit Member
                    </template>

                    <template #content>
                        <form @submit.prevent="submit" class="pb-20 md:pb-0">
                            <div>
                                <InputLabel for="name" value="Full Name" />
                                <TextInput
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="email" value="Email" />
                                <TextInput
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div class="grid grid-cols-2 mt-4 gap-3">
                                <div class="col-span-2 md:col-span-1">
                                    <InputLabel for="id_number" value="National ID No" />
                                    <TextInput
                                        id="id_number"
                                        v-model="form.id_number"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        autocomplete="id_number"
                                    />
                                    <InputError class="mt-2" :message="form.errors.id_number" />
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <InputLabel for="kra_tax_number" value="KRA Tax Number" />
                                    <TextInput
                                        id="kra_tax_number"
                                        v-model="form.kra_tax_number"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        autocomplete="kra_tax_number"
                                    />
                                    <InputError class="mt-2" :message="form.errors.kra_tax_number" />
                                </div>
                            </div>

                            <div class="grid grid-cols-2 mt-4 gap-3">
                                <div class="col-span-2 md:col-span-1">
                                    <InputLabel for="phone_number" value="Phone Number" />
                                    <TextInput
                                        id="phone_number"
                                        v-model="form.phone_number"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        autocomplete="phone_number"
                                    />
                                    <InputError class="mt-2" :message="form.errors.phone_number" />
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <InputLabel for="address" value="Address" />
                                    <TextInput
                                        id="address"
                                        v-model="form.address"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        autocomplete="address"
                                    />
                                    <InputError class="mt-2" :message="form.errors.address" />
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton class="ml-4" :class="{ 'opacity-75': form.processing }" :disabled="form.processing">
                                    Update Record
                                </PrimaryButton>
                            </div>
                        </form>
                    </template>
                </DialogModal>
            </div>
        </div>
    </AdminLayout>
</template>