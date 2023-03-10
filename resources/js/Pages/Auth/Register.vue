<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    id_number: '',
    phone_number: '',
    kra_tax_number: '',
    address: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

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

            <div class="mt-4 grid grid-cols-2 gap-3">
                <div class="col-span-2 md:col-span-1">
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="new-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>
                <div class="col-span-2 md:col-span-1">
                    <InputLabel for="password_confirmation" value="Confirm Password" />
                    <TextInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="new-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>
            </div>

            <div class="mt-4">
                
            </div>

            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                        </div>
                    </div>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </InputLabel>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </Link>
                
                <PrimaryButton class="ml-4 transition-[width] ease-linear duration-300" :class="{ 'opacity-90 w-fit': form.processing }" :disabled="form.processing">
                    <div class="text-white inline-flex space-x-2 items-center" v-if="form.processing">
                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 animate-spin">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"></path>
                        </svg>
                        <span class="whitespace-nowrap">Registering</span>
                    </div>
                    <span v-else>Register</span>
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
