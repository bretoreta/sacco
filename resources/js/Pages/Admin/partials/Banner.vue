<template>
	<Transition 
		enter-active-class="transform ease-out duration-400 transition"
		enter-class="-translate-y-10 opacity-0 sm:translate-y-0 sm:translate-x-10"
		enter-to-class="translate-y-0 opacity-100 sm:translate-x-0" 
		leave-active-class="transition ease-in duration-400"
		leave-class="opacity-100 translate-y-0" 
		leave-to-class="opacity-0 translate-y-10">
		<div id="banner" v-if="$page.props.flash.message" class="fixed bottom-0 right-0 max-w-full md:bottom-8 md:right-12 md:max-w-lg z-[100]">
			<div class="bg-white border border-gray-200 text-sm p-3 md:rounded shadow-xl flex justify-between">
				<div class="inline-flex items-center space-x-2">
					<div class="shrink-0">
						<svg v-show="$page.props.flash.message.type == 'success'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
							fill="currentColor" class="w-6 h-6 text-lime-500">
							<path fill-rule="evenodd"
								d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
								clip-rule="evenodd" />
						</svg>
						<svg v-show="$page.props.flash.message.type == 'error'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
							fill="currentColor" class="w-6 h-6 text-red-500">
							<path fill-rule="evenodd"
								d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
								clip-rule="evenodd" />
						</svg>
					</div>
					<span class="text-gray-700">{{ $page.props.flash.message.message }}</span>
				</div>
				<button class="text-gray-500 hover:text-gray-400 ml-5" @click="hide">
					<span class="sr-only">Close</span>
					<svg class="w-4 h-4 shrink-0 fill-current" viewBox="0 0 16 16">
						<path
							d="M12.72 3.293a1 1 0 00-1.415 0L8.012 6.586 4.72 3.293a1 1 0 00-1.414 1.414L6.598 8l-3.293 3.293a1 1 0 101.414 1.414l3.293-3.293 3.293 3.293a1 1 0 001.414-1.414L9.426 8l3.293-3.293a1 1 0 000-1.414z" />
					</svg>
				</button>
			</div>
		</div>
	</Transition>
</template>

<script>
	export default {
		methods: {
			hide() {
				document.getElementById('banner').classList.add('hidden');
			}
		}
	}
</script>