<template>
	<div class="flex h-screen overflow-hidden bg-gray-100">
        <Head :title="title" />

		<!-- Sidebar -->
		<Sidebar :sidebarOpen="sidebarOpen" @close-sidebar="sidebarOpen = false" />

		<!-- Content area -->
		<div class="relative flex flex-col flex-1 overflow-y-auto min-h-screen">

			<!-- Sidebar -->
			<Header :sidebarOpen="sidebarOpen" @toggle-sidebar="sidebarOpen = !sidebarOpen" />

			<main>
				<slot></slot>
			</main>

			<div class="flex w-full items-center justify-center py-10">
				<p class="uppercase text-gray-400 text-xs font-bold">Made with ❤ By Inkpot LLC</p>
			</div>

			<Banner :open="false" />

		</div>

	</div>
</template>

<script>
import { ref } from 'vue'
import Sidebar from '../Pages/Admin/partials/Sidebar.vue'
import Header from '../Pages/Admin/partials/Header.vue'
import Banner from '../Pages/Admin/partials/Banner.vue'
import { Head } from '@inertiajs/vue3';

export default {
	name: 'Dashboard',
    props: {
        title: String
    },
	components: {
		Sidebar,
		Header,
		Banner,
        Head,
	},
	setup() {

		const sidebarOpen = ref(false)

		return {
			sidebarOpen,
		}
	}
}
</script>