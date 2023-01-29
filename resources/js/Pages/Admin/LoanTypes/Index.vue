<script setup>
import { ref } from 'vue';
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

defineProps({
    loan_types: Object,
})

const NumberFormat = Intl.NumberFormat(undefined, { style: 'currency', currency: 'KES'});
const editingLoanType = ref(false);

const form = useForm({
    loan_type: '',
    loan_description: '',
    min_amount: '',
    max_amount: '',
});

const editForm = useForm({
    id: '',
    loan_type: '',
    loan_description: '',
    min_amount: '',
    max_amount: '',
})

const bannerTimeout = () => {
    setTimeout(() => {
        usePage().props.flash.message = null
    }, 4000)
}

const submit = () => {
    form.post(route('admin.loan.types.store'), {
        onSuccess: () => {
            form.reset(),
            bannerTimeout()
        }
    })
}

const editLoanType = (loan_type) => {
    editForm.id = loan_type.id
    editForm.loan_type = loan_type.loan_type
    editForm.loan_description = loan_type.loan_description
    editForm.min_amount = loan_type.min_amount
    editForm.max_amount = loan_type.max_amount

    editingLoanType.value = true;
}

const updateLoanType = () => {
    editForm.put(route('admin.loan.types.update', editForm.id), {
        onSuccess: () => {
            editForm.reset(),
            editingLoanType.value = false,
            bannerTimeout()
        }
    })
}

const deleteLoanType = (id) => {
    if(confirm("Are you sure to delete this loan type? All it's resources will be deleted!"))
    {
        router.delete(route('admin.loan.types.delete', id),
        { 
            preserveScroll:true,
            onSuccess: () => {
                bannerTimeout()
            }
        })
    }
}
</script>

<template>
    <AdminLayout title="Manage Loan Types">
        <div class="py-6 md:py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-12 gap-5 px-4 md:px-32">
                    <div class="col-span-12 md:col-span-8">
                        <div class="p-5 text-lg sm:rounded-t-xl font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                            Browse Loan Types
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
                        </div>
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Loan Type
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Description
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Minimum Amount
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Maximum Aount
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="sr-only">Manage</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="loan_type in loan_types.data" :key="loan_type.id">
                                        <tr class="bg-white border-b hover:bg-gray-50">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ loan_type.loan_type }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ loan_type.loan_description.substring(0, 50) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ NumberFormat.format(loan_type.min_amount) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ NumberFormat.format(loan_type.max_amount) }}
                                            </td>
                                            <td class="px-6 py-4 flex items-center space-x-2">
                                                <TooltipMin>
                                                    <template #button>
                                                        <button @click="editLoanType(loan_type)">
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
                                                        <button @click="deleteLoanType(loan_type.id)">
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
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                            <div v-if="!loan_types.data.length" class="bg-white w-full flex">
                                <div class="w-full py-4"><p class="text-xs italic text-center">No Data Found</p></div>
                            </div>
                        </div>
                        <Pagination v-if="loan_types.data.length" :data="loan_types" />
                    </div>
                    <div class="col-span-12 md:col-span-4">
                        <div class="bg-white rounded-lg shadow-md border border-gray-300 p-6">
                            <div class="text-lg font-bold text-left text-gray-900 bg-white">
                                Add Loan Type
                                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play.</p>
                            </div>
                            <form @submit.prevent="submit" class="mt-6">
                                <div>
                                    <InputLabel for="loan_type" value="Loan Type" />
                                    <TextInput
                                        id="loan_type"
                                        v-model="form.loan_type"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        autofocus
                                    />
                                    <InputError class="mt-2" :message="form.errors.loan_type" />
                                </div>

                                <div class="mt-4">
                                    <InputLabel for="loan_description" value="Loan Description" />
                                    <TextArea
                                        id="loan_description"
                                        v-model="form.loan_description"
                                        type="loan_description"
                                        class="mt-1 block w-full"
                                        required
                                    />
                                    <InputError class="mt-2" :message="form.errors.loan_description" />
                                </div>

                                <div class="mt-4">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="col-span-2 md:col-span-1">
                                            <InputLabel for="min_amount" value="Minimum Amount" />
                                            <TextInput
                                                id="min_amount"
                                                v-model="form.min_amount"
                                                type="number"
                                                class="mt-1 block w-full"
                                                required
                                            />
                                            <InputError class="mt-2" :message="form.errors.min_amount" />
                                        </div>
                                        <div class="col-span-2 md:col-span-1">
                                            <InputLabel for="max_amount" value="Maximum Amount" />
                                            <TextInput
                                                id="max_amount"
                                                v-model="form.max_amount"
                                                type="number"
                                                class="mt-1 block w-full"
                                                required
                                            />
                                            <InputError class="mt-2" :message="form.errors.max_amount" />
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end mt-4 w-full">
                                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Add New
                                    </PrimaryButton>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <DialogModal :show="editingLoanType" @close="editingLoanType = false">
                <template #title>
                    Edit Loan Type
                </template>

                <template #content>
                    <form @submit.prevent="updateLoanType" class="mt-6">
                        <div>
                            <InputLabel for="loan_type" value="Loan Type" />
                            <TextInput
                                id="loan_type"
                                v-model="editForm.loan_type"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                            />
                            <InputError class="mt-2" :message="editForm.errors.loan_type" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="loan_description" value="Loan Description" />
                            <TextArea
                                id="loan_description"
                                v-model="editForm.loan_description"
                                type="loan_description"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-2" :message="editForm.errors.loan_description" />
                        </div>

                        <div class="mt-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-2 md:col-span-1">
                                    <InputLabel for="min_amount" value="Minimum Amount" />
                                    <TextInput
                                        id="min_amount"
                                        v-model="editForm.min_amount"
                                        type="number"
                                        class="mt-1 block w-full"
                                        required
                                    />
                                    <InputError class="mt-2" :message="editForm.errors.min_amount" />
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <InputLabel for="max_amount" value="Maximum Amount" />
                                    <TextInput
                                        id="max_amount"
                                        v-model="editForm.max_amount"
                                        type="number"
                                        class="mt-1 block w-full"
                                        required
                                    />
                                    <InputError class="mt-2" :message="editForm.errors.max_amount" />
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-4 w-full">
                            <PrimaryButton :class="{ 'opacity-25': editForm.processing }" :disabled="editForm.processing">
                                Update Record
                            </PrimaryButton>
                        </div>
                    </form>
                </template>
            </DialogModal>
        </div>
    </AdminLayout>
</template>