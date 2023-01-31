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
    loans: Object,
    loan_types: Object,
    plans: Object,
})

const NumberFormat = Intl.NumberFormat(undefined, { style: 'currency', currency: 'KES'});
const editingLoan = ref(false);

const form = useForm({
    uuid: '',
    loan_id: '',
    plan_id: '',
    amount_payable: '',
});

const bannerTimeout = () => {
    setTimeout(() => {
        usePage().props.flash.message = null
    }, 4000)
}

const editLoan = (loan) => {
    form.uuid = loan.uuid
    form.loan_id = loan.loan_id;
    form.plan_id = loan.plan_id;
    form.amount_payable = loan.amount_payable;

    editingLoan.value = true;
}

const updateLoan = () => {
    form.put(route('admin.loans.update', form.uuid), {
        onSuccess: () => {
            form.reset(),
            editingLoan.value = false,
            bannerTimeout()
        }
    })
}

const approveLoan = (uuid) => {
    if(confirm("Are you sure to approve this loan type? A transaction will be recorded and the loan will be awarded to the applicant."))
    {
        console.log(uuid);
        router.post(route('admin.loans.approve.true', uuid), {} , {
            preserveScroll: true,
            onSuccess: () => {
                bannerTimeout()
            }
        })
    }
}

const rejectLoan = (uuid) => {
    if(confirm("Are you sure to reject this loan type? A transaction will not be recorded and the loan will not be awarded to the applicant."))
    {
        router.post(route('admin.loans.approve.false', uuid), {} , {
            preserveScroll: true,
            onSuccess: () => {
                bannerTimeout()
            }
        })
    }
}

const deleteLoan = (uuid) => {
    if(confirm("Are you sure to delete this loan type? All it's resources will be deleted!"))
    {
        router.delete(route('admin.loans.delete', uuid),
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
    <AdminLayout title="Manage Loans">
        <div class="py-6 md:py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-12 gap-5 px-4">
                    <div class="col-span-12">
                        <div class="p-5 text-lg sm:rounded-t-xl font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                            Approve Loans
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
                        </div>
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Date Applied
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Loan Type
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Applicant
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Amount Applied
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Plan Details
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="loan in loans.data" :key="loan.id">
                                        <tr class="bg-white border-b hover:bg-gray-50">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ loan.created }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ loan.loan.loan_type }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div>
                                                    <p>{{ loan.user.name }}</p>
                                                    <p>ID - {{ loan.user.id_number }}</p>
                                                    <p>Phone - {{ loan.user.phone_number }}</p>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ loan.amount_payable }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <p>{{ loan.plan.name }}</p>
                                                <p>Repayment in <span class="font-bold text-blue-500">{{ loan.plan.repayment_months }} months</span> at <span class="font-bold text-blue-500">{{ loan.plan.interest_rate }}%</span> - interest</p>
                                                <p>Penalty rate @<span class="font-bold text-blue-500">{{ loan.plan.penalty_rate }}%</span></p>
                                            </td>
                                            <td class="px-6 py-4">
                                                <button v-if="loan.status == 'pending'" class="px-2 py-1 rounded-md shadow-md bg-gray-500 text-white uppercase text-xs font-bold">
                                                    {{ loan.status }}
                                                </button>
                                                <button v-if="loan.status == 'approved'" class="px-2 py-1 rounded-md shadow-md bg-green-500 text-white uppercase text-xs font-bold">
                                                    {{ loan.status }}
                                                </button>
                                                <button v-if="loan.status == 'rejected'" class="px-2 py-1 rounded-md shadow-md bg-red-500 text-white uppercase text-xs font-bold">
                                                    {{ loan.status }}
                                                </button>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="quick_actions flex items-center justify-start space-x-3">
                                                    <TooltipMin v-if="loan.status == 'pending'">
                                                        <template #button>
                                                            <button @click="approveLoan(loan.uuid)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                                                                </svg>
                                                            </button>
                                                        </template>
                                                        <template #body>
                                                            <div class="text-gray-500">Approve</div>
                                                        </template>
                                                    </TooltipMin>
                                                    <TooltipMin v-if="loan.status == 'pending'">
                                                        <template #button>
                                                            <button @click="rejectLoan(loan.uuid)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 15h2.25m8.024-9.75c.011.05.028.1.052.148.591 1.2.924 2.55.924 3.977a8.96 8.96 0 01-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398C20.613 14.547 19.833 15 19 15h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 00.303-.54m.023-8.25H16.48a4.5 4.5 0 01-1.423-.23l-3.114-1.04a4.5 4.5 0 00-1.423-.23H6.504c-.618 0-1.217.247-1.605.729A11.95 11.95 0 002.25 12c0 .434.023.863.068 1.285C2.427 14.306 3.346 15 4.372 15h3.126c.618 0 .991.724.725 1.282A7.471 7.471 0 007.5 19.5a2.25 2.25 0 002.25 2.25.75.75 0 00.75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 002.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384" />
                                                                </svg>
                                                            </button>
                                                        </template>
                                                        <template #body>
                                                            <div class="text-gray-500">Reject</div>
                                                        </template>
                                                    </TooltipMin>
                                                    <TooltipMin>
                                                        <template #button>
                                                            <button @click="editLoan(loan)">
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
                                                            <button @click="deleteLoan(loan.uuid)">
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
                            <div v-if="!loans.data.length" class="bg-white w-full flex">
                                <div class="w-full py-4"><p class="text-xs italic text-center">No Data Found</p></div>
                            </div>
                        </div>
                        <Pagination v-if="loans.data.length" :data="loans" />
                    </div>
                </div>
            </div>
            <DialogModal :show="editingLoan" @close="editingLoan = false">
                <template #title>
                    Edit Loan Application
                </template>

                <template #content>
                    <form @submit.prevent="updateLoan" class="mt-6">
                        <div>
                            <InputLabel for="loan_id" value="Loan Type" />
                            <select v-model="form.loan_id" name="loan_id" id="loan_id"
                                class="border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                                required>
                                <template v-for="loan_type in loan_types" :key="loan_type.id">
                                    <option :value="loan_type.id">{{ loan_type.loan_type }}</option>
                                </template>
                            </select>
                            <InputError class="mt-2" :message="form.errors.loan_id" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="plan_id" value="Loan Type" />
                            <select v-model="form.plan_id" name="plan_id" id="plan_id"
                                class="border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                                required>
                                <template v-for="plan in plans" :key="plan.id">
                                    <option :value="plan.id">{{ plan.name }}</option>
                                </template>
                            </select>
                            <InputError class="mt-2" :message="form.errors.plan_id" />
                        </div>

                        <div class="mt-4">
                            <div class="col-span-2 md:col-span-1">
                                <InputLabel for="amount_payable" value="Amount Applied" />
                                <TextInput
                                    id="amount_payable"
                                    v-model="form.amount_payable"
                                    type="number"
                                    class="mt-1 block w-full"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.amount_payable" />
                            </div>
                        </div>

                        <div class="flex justify-end mt-4 w-full">
                            <PrimaryButton :class="{ 'opacity-75': form.processing }" :disabled="form.processing">
                                Update Record
                            </PrimaryButton>
                        </div>
                    </form>
                </template>
            </DialogModal>
        </div>
    </AdminLayout>
</template>