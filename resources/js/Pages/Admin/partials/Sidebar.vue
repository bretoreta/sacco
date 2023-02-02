<template>
	<div>
		<!-- Sidebar backdrop (mobile only) -->
		<div class="fixed inset-0 bg-slate-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200"
			:class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true"></div>

		<!-- Sidebar -->
		<div id="sidebar" ref="sidebar"
			class="flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-screen overflow-y-scroll lg:overflow-y-auto w-64 lg:w-20 lg:sidebar-expanded:!w-64 2xl:!w-64 shrink-0 bg-gradient-to-tr from-slate-900 to-blue-900 p-4 transition-all duration-200 ease-in-out"
			:class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'">

			<!-- Sidebar header -->
			<div class="flex items-center justify-between my-5">
				<!-- Close button -->
				<button ref="trigger" class="lg:hidden text-slate-500 hover:text-slate-400"
					@click.stop="$emit('close-sidebar')" aria-controls="sidebar" :aria-expanded="sidebarOpen">
					<span class="sr-only">Close sidebar</span>
					<svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
						<path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z" />
					</svg>
				</button>
				<!-- Logo -->
				<Link :href="route('admin.dashboard.index')" class="pl-3">
					<ApplicationMark class="block h-9 w-auto" />
					<p class="font-bold text-white mt-2">STORM SACCO</p>
				</Link>
			</div>

			<!-- Links -->
			<div class="space-y-8">
				<!-- Pages group -->
				<div>
					<h3 class="text-xs uppercase text-teal-300 font-semibold pl-3">
						<span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6"
							aria-hidden="true">•••</span>
						<span class="lg:hidden lg:sidebar-expanded:block 2xl:block">Management</span>
					</h3>
					<ul class="mt-3">
						<!-- Dashboard -->
						<SidebarLinkGroup v-slot="parentLink" :activeCondition="route().current('admin.dashboard.index')">
							<a class="block text-slate-200 hover:text-white truncate transition duration-200 py-2"
								:class="(route().current('admin.dashboard.index')) && 'hover:text-white'" href="#0"
								@click.prevent="sidebarExpanded ? parentLink.handleClick() : sidebarExpanded = true">
								<div class="flex items-center justify-between">
									<div class="flex items-center">
										<svg v-if="(route().current('admin.dashboard.*'))" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="rgb(94 234 212)" class="w-6 h-6">
											<path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
											<path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
										</svg>
										<svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 shrink-0">
											<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
										</svg>
										<span
											class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
									</div>
									<!-- Icon -->
									<div class="flex shrink-0 ml-2">
										<svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400"
											:class="parentLink.expanded && 'rotate-180'" viewBox="0 0 12 12">
											<path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
										</svg>
									</div>
								</div>
							</a>
							<div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
								<ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
									<Link :href="route('admin.dashboard.index')"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate"
										:class="(route().current('admin.dashboard.index')) && '!text-teal-300'">
									<span title="Admin Dashboard Overview"
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Overview</span>
									</Link>
								</ul>
							</div>
						</SidebarLinkGroup>

						<!-- Transactions -->
						<SidebarLinkGroup v-slot="parentLink" :activeCondition="route().current('admin.transactions.index')">
							<a class="block text-slate-200 hover:text-white truncate transition duration-200 py-2"
								:class="(route().current('admin.transactions.index')) && 'hover:text-white'" href="#0"
								@click.prevent="sidebarExpanded ? parentLink.handleClick() : sidebarExpanded = true">
								<div class="flex items-center justify-between">
									<div class="flex items-center">
										<svg xmlns="http://www.w3.org/2000/svg" :fill="(route().current('admin.transactions.*')) && 'rgb(94 234 212)'" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
											<path :class="(route().current('admin.transactions.*')) && '!text-teal-300'" stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
										</svg>
										<span
											class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Transactions</span>
									</div>
									<div class="flex shrink-0 ml-2">
										<svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400"
											:class="parentLink.expanded && 'rotate-180'" viewBox="0 0 12 12">
											<path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
										</svg>
									</div>
								</div>
							</a>
							<div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
								<ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
									<Link :href="route('admin.transactions.index')"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate"
										:class="(route().current('admin.transactions.index')) && '!text-teal-300'">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Overview</span>
									</Link>
									<Link :href="'/admin/dashboard'"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Member Accounts</span>
									</Link>
									<Link :href="'/admin/dashboard'"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Admin Accounts</span>
									</Link>
								</ul>
							</div>
						</SidebarLinkGroup>

						<!-- Loans -->
						<SidebarLinkGroup v-slot="parentLink" :activeCondition="route().current('admin.loans.*')">
							<a class="block text-slate-200 hover:text-white truncate transition duration-200 py-2"
								:class="(route().current('admin.loans.*')) && 'hover:text-white'" href="#0"
								@click.prevent="sidebarExpanded ? parentLink.handleClick() : sidebarExpanded = true">
								<div class="flex items-center justify-between">
									<div class="flex items-center">
										<svg xmlns="http://www.w3.org/2000/svg" :fill="(route().current('admin.loans.*')) && 'rgb(94 234 212)'" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
											<path :class="(route().current('admin.loans.*')) && '!text-teal-300'" stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
											<path :class="(route().current('admin.loans.*')) && '!text-teal-300'" stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
										</svg>
										<span
											class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Loans</span>
									</div>
									<div class="flex shrink-0 ml-2">
										<svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400"
											:class="parentLink.expanded && 'rotate-180'" viewBox="0 0 12 12">
											<path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
										</svg>
									</div>
								</div>
							</a>
							<div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
								<ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
									<Link :href="route('admin.loans.index')"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate"
										:class="(route().current('admin.loans.index')) && '!text-teal-300'">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Overview</span>
									</Link>
									<Link :href="route('admin.loans.create')"
									:class="(route().current('admin.loans.create')) && '!text-teal-300'"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Add Application</span>
									</Link>
									<Link :href="route('admin.loans.approve')"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate"
										:class="(route().current('admin.loans.approve')) && '!text-teal-300'">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Approval Panel</span>
									</Link>
									<Link :href="route('admin.loans.types.index')"
									:class="(route().current('admin.loans.types.index')) && '!text-teal-300'"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Loan Types</span>
									</Link>
								</ul>
							</div>
						</SidebarLinkGroup>

						<!-- Members -->
						<SidebarLinkGroup v-slot="parentLink" :activeCondition="route().current('admin.members.index')">
							<a class="block text-slate-200 hover:text-white truncate transition duration-200 py-2"
								:class="(route().current('admin.members.index')) && 'hover:text-white'" href="#0"
								@click.prevent="sidebarExpanded ? parentLink.handleClick() : sidebarExpanded = true">
								<div class="flex items-center justify-between">
									<div class="flex items-center">
										<svg xmlns="http://www.w3.org/2000/svg" :fill="(route().current('admin.members.*')) && 'rgb(94 234 212)'" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 shrink-0">
											<path :class="(route().current('admin.members.*')) && '!text-teal-300'" stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
										</svg>
										<span
											class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Members</span>
									</div>
									<div class="flex shrink-0 ml-2">
										<svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400"
											:class="parentLink.expanded && 'rotate-180'" viewBox="0 0 12 12">
											<path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
										</svg>
									</div>
								</div>
							</a>
							<div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
								<ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
									<Link :href="route('admin.members.index')"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate"
										:class="(route().current('admin.members.index')) && '!text-teal-300'">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Overview</span>
									</Link>
									<Link :href="'/admin/dashboard'"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage Members</span>
									</Link>
									<Link :href="'/admin/dashboard'"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Settings</span>
									</Link>
								</ul>
							</div>
						</SidebarLinkGroup>

						<!-- Meetings -->
						<SidebarLinkGroup v-slot="parentLink" :activeCondition="route().current('admin.meetings.index')">
							<a class="block text-slate-200 hover:text-white truncate transition duration-200 py-2"
								:class="(route().current('admin.meetings.index')) && 'hover:text-white'" href="#0"
								@click.prevent="sidebarExpanded ? parentLink.handleClick() : sidebarExpanded = true">
								<div class="flex items-center justify-between">
									<div class="flex items-center">
										<svg v-if="(route().current('admin.meetings.*'))" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="rgb(94 234 212)" class="w-6 h-6">
											<path d="M4.5 4.5a3 3 0 00-3 3v9a3 3 0 003 3h8.25a3 3 0 003-3v-9a3 3 0 00-3-3H4.5zM19.94 18.75l-2.69-2.69V7.94l2.69-2.69c.944-.945 2.56-.276 2.56 1.06v11.38c0 1.336-1.616 2.005-2.56 1.06z" />
										</svg>
										<svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 shrink-0">
											<path stroke-linecap="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
										</svg>
										<span
											class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Meetings</span>
									</div>
									<div class="flex shrink-0 ml-2">
										<svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400"
											:class="parentLink.expanded && 'rotate-180'" viewBox="0 0 12 12">
											<path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
										</svg>
									</div>
								</div>
							</a>
							<div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
								<ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
									<Link :href="route('admin.meetings.index')"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate"
										:class="(route().current('admin.meetings.index')) && '!text-teal-300'">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Overview</span>
									</Link>
									<Link :href="'/admin/dashboard'"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage Meetings</span>
									</Link>
									<Link :href="'/admin/dashboard'"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Settings</span>
									</Link>
								</ul>
							</div>
						</SidebarLinkGroup>

						<!-- Legal Docs TODO: Make Stroke Change To Teal -->
						<SidebarLinkGroup v-slot="parentLink" :activeCondition="route().current('admin.legals.index')">
							<a class="block text-slate-200 hover:text-white truncate transition duration-200 py-2"
								:class="(route().current('admin.legals.index')) && 'hover:text-white'" href="#0"
								@click.prevent="sidebarExpanded ? parentLink.handleClick() : sidebarExpanded = true">
								<div class="flex items-center justify-between">
									<div class="flex items-center">
										<svg xmlns="http://www.w3.org/2000/svg" :fill="(route().current('admin.legals.*')) && 'rgb(94 234 212)'" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
											<path :class="(route().current('admin.meetings.*')) && '!text-teal-300'" stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 01-2.031.352 5.989 5.989 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971z" />
										</svg>
										<span
											class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Legal Docs</span>
									</div>
									<div class="flex shrink-0 ml-2">
										<svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400"
											:class="parentLink.expanded && 'rotate-180'" viewBox="0 0 12 12">
											<path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
										</svg>
									</div>
								</div>
							</a>
							<div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
								<ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
									<Link :href="route('admin.legals.index')"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate"
										:class="(route().current('admin.legals.index')) && '!text-teal-300'">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Overview</span>
									</Link>
									<Link :href="'/admin/dashboard'"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage Documents</span>
									</Link>
									<Link :href="'/admin/dashboard'"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Settings</span>
									</Link>
								</ul>
							</div>
						</SidebarLinkGroup>

						<!-- Mailroom -->
						<SidebarLinkGroup v-slot="parentLink" :activeCondition="route().current('admin.mailroom.index')">
							<a class="block text-slate-200 hover:text-white truncate transition duration-200 py-2"
								:class="(route().current('admin.mailroom.index')) && 'hover:text-white'" href="#0"
								@click.prevent="sidebarExpanded ? parentLink.handleClick() : sidebarExpanded = true">
								<div class="flex items-center justify-between">
									<div class="flex items-center">
										<svg v-if="(route().current('admin.mailroom.*'))" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="rgb(94 234 212)" class="w-6 h-6">
											<path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
											<path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
										</svg>
										<svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
											<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
										</svg>
										<span
											class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Mail Room</span>
									</div>
									<div class="flex shrink-0 ml-2">
										<svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400"
											:class="parentLink.expanded && 'rotate-180'" viewBox="0 0 12 12">
											<path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
										</svg>
									</div>
								</div>
							</a>
							<div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
								<ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
									<Link :href="route('admin.mailroom.index')"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate"
										:class="(route().current('admin.mailroom.index')) && '!text-teal-300'">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Overview</span>
									</Link>
									<Link :href="'/admin/dashboard'"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Compose</span>
									</Link>
									<Link :href="'/admin/dashboard'"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Manage Templates</span>
									</Link>
									<Link :href="'/admin/dashboard'"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Settings</span>
									</Link>
								</ul>
							</div>
						</SidebarLinkGroup>
					</ul>
					<h3 class="text-xs uppercase text-teal-300 font-semibold pl-3 mt-6">
						<span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6"
							aria-hidden="true">•••</span>
						<span class="lg:hidden lg:sidebar-expanded:block 2xl:block">Advanced</span>
					</h3>
					<ul class="my-3">
						<!-- Settings -->
						<SidebarLinkGroup v-slot="parentLink" :activeCondition="route().current('admin.settings.index')">
							<a class="block text-slate-200 hover:text-white truncate transition duration-200 py-2"
								:class="(route().current('admin.settings.index')) && 'hover:text-white'" href="#0"
								@click.prevent="sidebarExpanded ? parentLink.handleClick() : sidebarExpanded = true">
								<div class="flex items-center justify-between">
									<div class="flex items-center">
										<svg v-if="(route().current('admin.settings.*'))" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-teal-300">
											<path fill-rule="evenodd" d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 00-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 00-2.282.819l-.922 1.597a1.875 1.875 0 00.432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 000 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 00-.432 2.385l.922 1.597a1.875 1.875 0 002.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 002.28-.819l.923-1.597a1.875 1.875 0 00-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 000-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 00-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 00-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 00-1.85-1.567h-1.843zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" clip-rule="evenodd" />
										</svg>
										<svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
											<path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
											<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
										</svg>
										<span
											class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">App Settings</span>
									</div>
									<!-- Icon -->
									<div class="flex shrink-0 ml-2">
										<svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400"
											:class="parentLink.expanded && 'rotate-180'" viewBox="0 0 12 12">
											<path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
										</svg>
									</div>
								</div>
							</a>
							<div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
								<ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
									<Link :href="route('admin.settings.index')"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate"
										:class="(route().current('admin.settings.index')) && '!text-teal-300'">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Overview</span>
									</Link>
									<Link :href="'/admin/dashboard'"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Projections</span>
									</Link>
									<Link :href="'/admin/dashboard'"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Performance</span>
									</Link>
									<Link :href="'/admin/dashboard'"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Settings</span>
									</Link>
								</ul>
							</div>
						</SidebarLinkGroup>

						<!-- Feedback Hub -->
						<SidebarLinkGroup v-slot="parentLink" :activeCondition="route().current('admin.feedback.index')">
							<a class="block text-slate-200 hover:text-white truncate transition duration-200 py-2"
								:class="(route().current('admin.feedback.index')) && 'hover:text-white'" href="#0"
								@click.prevent="sidebarExpanded ? parentLink.handleClick() : sidebarExpanded = true">
								<div class="flex items-center justify-between">
									<div class="flex items-center">
										<svg v-if="(route().current('admin.feedback.*'))" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
											<path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
										</svg>
										<svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
											<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
										</svg>
										<span
											class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Feedback Hub</span>
									</div>
									<!-- Icon -->
									<div class="flex shrink-0 ml-2">
										<svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400"
											:class="parentLink.expanded && 'rotate-180'" viewBox="0 0 12 12">
											<path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
										</svg>
									</div>
								</div>
							</a>
							<div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
								<ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
									<Link :href="route('admin.feedback.index')"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate"
										:class="(route().current('admin.feedback.index')) && '!text-teal-300'">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Overview</span>
									</Link>
									<Link :href="'/admin/dashboard'"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Projections</span>
									</Link>
									<Link :href="'/admin/dashboard'"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Performance</span>
									</Link>
									<Link :href="'/admin/dashboard'"
										class="mb-1 last:mb-0 block text-slate-400 hover:text-slate-200 transition duration-150 truncate">
									<span
										class="text-sm font-light lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Settings</span>
									</Link>
								</ul>
							</div>
						</SidebarLinkGroup>
					</ul>
				</div>
			</div>

			<!-- Expand / collapse button -->
			<div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
				<div class="px-3 py-2">
					<button @click.prevent="sidebarExpanded = !sidebarExpanded">
						<span class="sr-only">Expand / collapse sidebar</span>
						<svg class="w-6 h-6 fill-current sidebar-expanded:rotate-180" viewBox="0 0 24 24">
							<path class="text-slate-400"
								d="M19.586 11l-5-5L16 4.586 23.414 12 16 19.414 14.586 18l5-5H7v-2z" />
							<path class="text-slate-600" d="M3 23H1V1h2z" />
						</svg>
					</button>
				</div>
			</div>

		</div>
	</div>
</template>

<script>
import { Link } from '@inertiajs/vue3'
import { ref, onMounted, onUnmounted, watch } from 'vue'

import SidebarLinkGroup from './SidebarLinkGroup.vue'
import ApplicationMark from '@/Components/ApplicationMark.vue';

export default {
	name: 'Sidebar',
	props: ['sidebarOpen'],
	components: {
		SidebarLinkGroup, Link, ApplicationMark
	},
	setup(props, { emit }) {

		const trigger = ref(null)
		const sidebar = ref(null)

		const storedSidebarExpanded = localStorage.getItem('sidebar-expanded')
		const sidebarExpanded = ref(storedSidebarExpanded === null ? false : storedSidebarExpanded === 'true')

		// close on click outside
		const clickHandler = ({ target }) => {
			if (!sidebar.value || !trigger.value) return
			if (
				!props.sidebarOpen ||
				sidebar.value.contains(target) ||
				trigger.value.contains(target)
			) return
			emit('close-sidebar')
		}

		// close if the esc key is pressed
		const keyHandler = ({ keyCode }) => {
			if (!props.sidebarOpen || keyCode !== 27) return
			emit('close-sidebar')
		}

		onMounted(() => {
			document.addEventListener('click', clickHandler)
			document.addEventListener('keydown', keyHandler)
		})

		onUnmounted(() => {
			document.removeEventListener('click', clickHandler)
			document.removeEventListener('keydown', keyHandler)
		})

		watch(sidebarExpanded, () => {
			localStorage.setItem('sidebar-expanded', sidebarExpanded.value)
			if (sidebarExpanded.value) {
				document.querySelector('body').classList.add('sidebar-expanded')
			} else {
				document.querySelector('body').classList.remove('sidebar-expanded')
			}
		})

		return {
			trigger,
			sidebar,
			sidebarExpanded,
		}
	},
}
</script>