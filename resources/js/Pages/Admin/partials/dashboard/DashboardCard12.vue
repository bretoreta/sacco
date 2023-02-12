<template>
	<div class="col-span-full xl:col-span-6 bg-white shadow-lg rounded-sm border border-gray-200">
		<header class="px-5 py-4 border-b border-gray-100">
			<h2 class="font-semibold text-gray-800">Recent Activity</h2>
		</header>
		<div class="p-3">

			<!-- Card content -->
			<!-- "Today" group -->
			<div>
				<header class="text-xs uppercase text-gray-400 bg-gray-50 rounded-sm font-semibold p-2">Today</header>
				<ul class="my-1">
					<!-- Item -->
					<li class="flex px-2">
						<div
							class="w-9 h-9 rounded-full shrink-0 bg-indigo-500 my-2 mr-3 grid items-center justify-center">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
								stroke="currentColor" class="w-5 h-5 text-white">
								<path stroke-linecap="round" stroke-linejoin="round"
									d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
							</svg>
						</div>
						<div class="grow flex items-center border-b border-gray-100 text-sm py-2">
							<div class="grow flex justify-between">
								<div class="self-center"><a class="font-medium text-gray-800 hover:text-gray-900"
										href="#0">Nick
										Mark</a> disbursed a loan <a class="font-medium text-gray-800" href="#0">Sara
										Smith</a> of Ksh.
									300,000</div>
								<div class="shrink-0 self-end ml-2">
									<a class="inline-flex items-center font-medium text-indigo-500 hover:text-indigo-600"
										href="#0">View
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
											stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
											<path stroke-linecap="round" stroke-linejoin="round"
												d="M8.25 4.5l7.5 7.5-7.5 7.5" />
										</svg>
									</a>
								</div>
							</div>
						</div>
					</li>
					<!-- Item -->
					<li class="flex px-2">
						<div class="w-9 h-9 rounded-full shrink-0 bg-red-500 my-2 mr-3">
							<svg class="w-9 h-9 fill-current text-red-50" viewBox="0 0 36 36">
								<path d="M25 24H11a1 1 0 01-1-1v-5h2v4h12v-4h2v5a1 1 0 01-1 1zM14 13h8v2h-8z" />
							</svg>
						</div>
						<div class="grow flex items-center border-b border-gray-100 text-sm py-2">
							<div class="grow flex justify-between">
								<div class="self-center">The loan type <a class="font-medium text-gray-800"
										href="#0">Mortgage Loan</a> was
									removed by <a class="font-medium text-gray-800 hover:text-gray-900" href="#0">Bret
										Oreta</a></div>
								<div class="shrink-0 self-end ml-2">
									<a class="inline-flex items-center font-medium text-indigo-500 hover:text-indigo-600"
										href="#0">View
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
											stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
											<path stroke-linecap="round" stroke-linejoin="round"
												d="M8.25 4.5l7.5 7.5-7.5 7.5" />
										</svg>
									</a>
								</div>
							</div>
						</div>
					</li>
					<!-- Item -->
					<li class="flex px-2">
						<div class="w-9 h-9 rounded-full shrink-0 bg-green-500 my-2 mr-3">
							<svg class="w-9 h-9 fill-current text-green-50" viewBox="0 0 36 36">
								<path d="M15 13v-3l-5 4 5 4v-3h8a1 1 0 000-2h-8zM21 21h-8a1 1 0 000 2h8v3l5-4-5-4v3z" />
							</svg>
						</div>
						<div class="grow flex items-center text-sm py-2">
							<div class="grow flex justify-between">
								<div class="self-center"><a class="font-medium text-gray-800 hover:text-gray-900"
										href="#0">Patrick
										Sullivan</a> published a new <a class="font-medium text-gray-800" href="#0">loan
										type</a></div>
								<div class="shrink-0 self-end ml-2">
									<a class="inline-flex items-center font-medium text-indigo-500 hover:text-indigo-600"
										href="#0">View
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
											stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
											<path stroke-linecap="round" stroke-linejoin="round"
												d="M8.25 4.5l7.5 7.5-7.5 7.5" />
										</svg>
									</a>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<!-- "Yesterday" group -->
			<div>
				<header class="text-xs uppercase text-gray-400 bg-gray-50 rounded-sm font-semibold p-2">Yesterday
				</header>
				<ul class="my-1">
					<!-- Item -->
					<li class="flex px-2">
						<div class="w-9 h-9 rounded-full shrink-0 bg-sky-500 my-2 mr-3">
							<svg class="w-9 h-9 fill-current text-sky-50" viewBox="0 0 36 36">
								<path
									d="M23 11v2.085c-2.841.401-4.41 2.462-5.8 4.315-1.449 1.932-2.7 3.6-5.2 3.6h-1v2h1c3.5 0 5.253-2.338 6.8-4.4 1.449-1.932 2.7-3.6 5.2-3.6h3l-4-4zM15.406 16.455c.066-.087.125-.162.194-.254.314-.419.656-.872 1.033-1.33C15.475 13.802 14.038 13 12 13h-1v2h1c1.471 0 2.505.586 3.406 1.455zM24 21c-1.471 0-2.505-.586-3.406-1.455-.066.087-.125.162-.194.254-.316.422-.656.873-1.028 1.328.959.878 2.108 1.573 3.628 1.788V25l4-4h-3z" />
							</svg>
						</div>
						<div class="grow flex items-center border-b border-gray-100 text-sm py-2">
							<div class="grow flex justify-between">
								<div class="self-center"><a class="font-medium text-gray-800 hover:text-gray-900"
										href="#0">240+</a>
									users have subscribed to <a class="font-medium text-gray-800" href="#0">General
										Newsletter</a></div>
								<div class="shrink-0 self-end ml-2">
									<a class="inline-flex items-center font-medium text-indigo-500 hover:text-indigo-600"
										href="#0">View
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
											stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
											<path stroke-linecap="round" stroke-linejoin="round"
												d="M8.25 4.5l7.5 7.5-7.5 7.5" />
										</svg>
									</a>
								</div>
							</div>
						</div>
					</li>
					<!-- Item -->
					<li class="flex px-2">
						<div
							class="w-9 h-9 rounded-full shrink-0 bg-indigo-500 my-2 mr-3 grid items-center justify-center">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
								stroke="currentColor" class="w-5 h-5 text-white">
								<path stroke-linecap="round" stroke-linejoin="round"
									d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
							</svg>
						</div>
						<div class="grow flex items-center border-b border-gray-100 text-sm py-2">
							<div class="grow flex justify-between">
								<div class="self-center"><a class="font-medium text-gray-800 hover:text-gray-900"
										href="#0">Nick
										Mark</a> disbursed a loan <a class="font-medium text-gray-800" href="#0">Joseph
										Massika</a> of Ksh.
									100,000</div>
								<div class="shrink-0 self-end ml-2">
									<a class="inline-flex items-center font-medium text-indigo-500 hover:text-indigo-600"
										href="#0">View
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
											stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
											<path stroke-linecap="round" stroke-linejoin="round"
												d="M8.25 4.5l7.5 7.5-7.5 7.5" />
										</svg>
									</a>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>

		</div>
	</div>
</template>

<script>
export default {
	name: 'DashboardCard12',
}
</script>