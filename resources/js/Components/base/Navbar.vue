<script setup>
import { Link, router } from '@inertiajs/vue3';
import BaseButton from "@/Components/base/Button.vue";

const goToLogin = () => {
	router.visit(route('login'));
}

const goToRegister = () => {
	router.visit(route('login'));
}

</script>
<template>
	<nav id="navbar" class="relative z-10 w-full text-neutral-800">
		<div class="flex flex-col max-w-screen-xl px-8 mx-auto lg:items-center lg:justify-between lg:flex-row py-4">
			<div class="flex flex-col lg:flex-row items-center space-x-8 xl:space-x-20">
				<div class="w-full flex flex-row items-center justify-between py-6">
					<div>
						<img src="../../../img/iconAsset3@4x.png" class="w-12" alt="Nefa Logo" />
					</div>
				</div>
				<ul :class="[open ? 'flex' : 'hidden lg:flex']"
					class="w-full h-auto flex flex-col flex-grow lg:items-center pb-4 lg:pb-0 lg:justify-end lg:flex-row origin-top duration-300 xl:space-x-10 space-y-3 lg:space-y-0">
					<Link :href="route('login')" class="text-sm font-semibold text-gray-500">Home</Link>
					<Link :href="route('login')" class="text-sm font-semibold text-gray-500">Features</Link>
					<Link :href="route('login')" class="text-sm font-semibold text-gray-500">Pricing</Link>
					<Link :href="route('login')" class="text-sm font-semibold text-gray-500">Contact</Link>
				</ul>
			</div>
			<div :class="[open ? 'flex' : 'hidden lg:flex']" class="space-x-3">
				<base-button @click="goToLogin" class="px-8 xl:px-10 py-2 mt-2 bg-inherit text-gradient border border-[#0c66ee]">
					Login
				</base-button>
				<base-button @click="goToRegister" class="px-8 xl:px-10 py-2 mt-2 bg-gradient-to-r from-[#468ef9] to-[#0c66ee] text-white">
					Sign Up
				</base-button>
			</div>
		</div>
	</nav>
</template>
<script>
export default {
	name: 'BaseNavbar',
	data() {
		return {
			open: false,
			dropdownNavbar: false,
		}
	},
	methods: {
		dropdownToggler() {
			this.dropdownNavbar = !this.dropdownNavbar
		}
	}
}
</script>
