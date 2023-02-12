<script setup>
    import AdminLayout from '@/Layouts/AdminLayout.vue'
    import WelcomeBanner from '@/Pages/Admin/partials/dashboard/WelcomeBanner.vue'
    import FilterButton from '@/Components/DropdownFilter.vue'
    import DashboardCard01 from '@/Pages/Admin/partials/dashboard/DashboardCard01.vue'
    import DashboardCard02 from '@/Pages/Admin/partials/dashboard/DashboardCard02.vue'
    import DashboardCard03 from '@/Pages/Admin/partials/dashboard/DashboardCard03.vue'
    import DashboardCard04 from '@/Pages/Admin/partials/dashboard/DashboardCard04.vue'
    import DashboardCard05 from '@/Pages/Admin/partials/dashboard/DashboardCard05.vue'
    import DashboardCard06 from '@/Pages/Admin/partials/dashboard/DashboardCard06.vue'
    import DashboardCard07 from '@/Pages/Admin/partials/dashboard/DashboardCard07.vue'
    import DashboardCard10 from '@/Pages/Admin/partials/dashboard/DashboardCard10.vue'
    import DashboardCard11 from '@/Pages/Admin/partials/dashboard/DashboardCard11.vue'
    import DashboardCard12 from '@/Pages/Admin/partials/dashboard/DashboardCard12.vue'
    import DashboardCard13 from '@/Pages/Admin/partials/dashboard/DashboardCard13.vue'
</script>

<template>
	<AdminLayout title="Administrator Dashboard">
		<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

			<!-- Welcome banner -->
			<WelcomeBanner />

			<!-- Cards -->
			<div class="grid grid-cols-12 gap-6">

				<!-- Line chart (Acme Plus) -->
				<DashboardCard01 />
				<!-- Line chart (Acme Advanced) -->
				<DashboardCard02 />
				<!-- Line chart (Acme Professional) -->
				<DashboardCard03 />
				<!-- Bar chart (Direct vs Indirect) -->
				<DashboardCard04 />
				<!-- Line chart (Real Time Value) -->
				<DashboardCard05 />
				<!-- Doughnut chart (Top Countries) -->
				<DashboardCard06 />
				<!-- Table (Top Channels) -->
				<DashboardCard07 />
				<!-- Card (Customers)  -->
				<DashboardCard10 />
				<!-- Card (Reasons for Refunds)   -->
				<DashboardCard11 />
				<!-- Card (Recent Activity) -->
				<DashboardCard12 />
				<!-- Card (Income/Expenses) -->
				<DashboardCard13 />

			</div>

		</div>
	</AdminLayout>
</template>