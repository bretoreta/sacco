<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import BaseSection from "@/Components/base/Section.vue";
import BaseButton from "@/Components/base/Button.vue";
import LandingBuyTradeImage from "@/Components/landing/BuyTradeImage.vue";
import LandingCryptoStatistic from "@/Components/landing/CryptoStatistic.vue";
import LandingListItem from "@/Components/landing/ListItem.vue";
import LandingPartnerImage from "@/Components/landing/PartnerImage.vue";
import LandingStep from "@/Components/landing/Step.vue";
import LandingTradingToolImage from "@/Components/landing/TradingToolImage.vue";

</script>
<template>
	<AppLayout>
		<div class="w-full">
			<!-- Hero section -->
			<section id="hero" class="w-full pb-24">
				<BaseSection>
					<div
						class="col-span-12 lg:col-span-6 mt-12 xl:mt-10 space-y-4 sm:space-y-8 px-6 text-center sm:text-left pb-20 pt-10">
						<span data-aos="fade-right" data-aos-once="true"
							class="text-base text-gradient font-semibold uppercase">Welcome To Storm Sacco</span>
						<h1 data-aos="fade-right" data-aos-once="true"
							class="text-[2.5rem] sm:text-5xl xl:text-6xl font-bold leading-tight capitalize sm:pr-8 xl:pr-10">
							Digitalize your <span class="text-header-gradient">Growing Sacco</span> With Storm 🚀
						</h1>
						<p data-aos="fade-down" data-aos-once="true" data-aos-delay="300" class="paragraph hidden sm:block">
							Manage your microfinance instutution with ease today with Storm Sacco Management Software
						</p>
						<div data-aos="fade-up" data-aos-once="true" data-aos-delay="700"
							class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mt-2">
							<BaseButton
								class="max-w-full px-8 py-4 bg-gradient-to-r from-[#468ef9] to-[#0c66ee] border border-[#0c66ee] text-white">
								Get Started
							</BaseButton>
							<BaseButton
								class="max-w-full px-6 py-4 bg-inherit text-gradient border border-[#0c66ee] flex items-center justify-center">
								<span>More Info</span>
							</BaseButton>
						</div>
					</div>
					<div class="hidden sm:block col-span-12 lg:col-span-6">
						<div class="w-full pt-20">
							<img data-aos="fade-up" data-aos-once="true" src="../../img/home/documentation_illustration.png"/>
						</div>
					</div>
					<img data-aos="fade-up" data-aos-delay="300" src="../../img/pattern/ellipse-1.png"
						class="hidden sm:block absolute bottom-12 xl:bottom-16 left-4 xl:left-0 w-6" />
					<img data-aos="fade-up" data-aos-delay="300" src="../../img/pattern/ellipse-2.png"
						class="hidden sm:block absolute top-4 sm:top-10 right-64 sm:right-96 xl:right-[32rem] w-6" />
					<img data-aos="fade-up" data-aos-delay="300" src="../../img/pattern/ellipse-3.png"
						class="hidden sm:block absolute bottom-56 right-24 w-6" />
					<img data-aos="fade-up" data-aos-delay="300" src="../../img/pattern/star.png"
						class="hidden sm:block absolute top-20 sm:top-28 right-16 lg:right-0 lg:left-[32rem] w-8" />
				</BaseSection>
			</section>

			<!-- Crypto statistic section -->
			<section
				class="max-w-screen-xl mx-2 sm:mx-auto px-4 sm:px-6 lg:px-0 py-6 pb-20 sm:py-8 rounded-[2.25rem] sm:rounded-xl bg-white shadow-lg sm:shadow-md transform lg:-translate-y-12">
				<div class="w-full flex flex-col lg:flex-row items-center justify-center">
					<LandingCryptoStatistic data-aos="fade-up" title="🔥 Recently Added Features" :datasets="trendings"
						class="xl:border-r border-gray-200 lg:px-8" />
					<LandingCryptoStatistic data-aos="fade-up" data-aos-delay="150" title="🚀 Upcoming Updates"
						:datasets="topGainers" class="xl:border-r border-gray-200 lg:px-8" />
					<LandingCryptoStatistic data-aos="fade-up" data-aos-delay="300" title="💎 Product Releases"
						:datasets="recents" class="lg:px-8" />
				</div>
			</section>

			<!-- Buy and trade section -->
			<section class="w-full my-24">
				<div class="flex w-full items-center max-w-screen-xl px-4 sm:px-8 mx-auto">
					<div class="w-full md:w-1/2">
						<LandingBuyTradeImage class="sm:hidden mb-8" />
						<div data-aos="fade-right" data-aos-delay="200" class="col-span-12 lg:col-span-6 mt-4 space-y-10 px-4">
							<h2 class="text-5xl font-semibold">
								Everthing <span class="text-header-gradient font-bold">YOU NEED</span> Under One Roof
							</h2>
							<p class="paragraph max-w-2xl">
								Storm Sacco Management System is the perfect choice for anyone looking for a comprehensive and feature-rich experience. It has all of the features someone needs under the hood, including an intuitive user interface, powerful search capabilities, secure data storage and sharing options, integration with other popular apps and services, plus much more. 
							</p>
							<p class="paragraph max-w-2xl">With our app you can easily manage your tasks quickly and efficiently while staying organized wherever you go!</p>
							<BaseButton
								class="max-w-full px-8 py-4 bg-gradient-to-r from-[#468ef9] to-[#0c66ee] border border-[#0c66ee] text-white">
								Get Started
							</BaseButton>
						</div>
					</div>
					<div class="hidden lg:block lg:w-1/2">
						<LandingBuyTradeImage data-aos="fade-left" data-aos-delay="200" class="hidden sm:block" />
					</div>
				</div>
			</section>

			<!-- Partners section -->
			<section class="bg-white relative max-w-full sm:mx-6 my-24 shadow sm:rounded-2xl overflow-hidden">
				<div class="w-full px-6 sm:px-0 py-16 flex flex-col items-center justify-center space-y-4 text-center">
					<h3 data-aos="fade-down" data-aos-delay="200" class="text-2xl text-neutral-800 font-semibold">Trusted Clients</h3>
					<p data-aos="fade-down" data-aos-delay="200" class="paragraph">We've worked with several major organisations around the
						country</p>
					<div data-aos="fade-up" data-aos-delay="200" class="flex flex-wrap items-center justify-center">
						<LandingPartnerImage
							v-for="img in ['clever.png', 'diamon-cutts.png', 'swiss-finance.png', 'gambio.png']" :key="img"
							:img="img" />
					</div>
				</div>
			</section>

			<!-- Credit card section -->
			<section class="w-full my-36">
				<BaseSection data-aos="fade-down" data-aos-delay="200">
					<div class="col-span-12 lg:col-span-7">
						<div class="w-full">
							<img src="../../img/nefa-cc.webp" class="w-[95%]" alt="" />
						</div>
					</div>
					<div class="col-span-12 lg:col-span-5 space-y-6 px-4 sm:px-6">
						<h2 class="text-4xl font-semibold">
							Manage <span class="text-header-gradient">VIRTUAL</span> Credit Cards
						</h2>
						<p class="paragraph">Storm Sacco Comes loaded with great virtual credit card abilities that provides users with the convenience and security of using a virtual credit card without ever having to carry one. </p>
						<p class="paragraph">With this feature, users can easily make repayments online, track spending habits and manage their budget from anywhere. Additionally, it helps protect against fraud by providing an extra layer of security for sensitive information. </p>
						<BaseButton
							class="max-w-full px-8 py-4 bg-gradient-to-r from-[#468ef9] to-[#0c66ee] border border-[#0c66ee] text-white">
							Features
						</BaseButton>
					</div>
				</BaseSection>
			</section>

			<!-- Advanced trading tools section -->
			<section class="bg-white relative max-w-full sm:mx-4 my-20 py-16 shadow rounded-2xl overflow-hidden">
				<div class="relative max-w-screen-xl px-4 sm:px-2 mx-auto grid grid-cols-12 gap-x-6">
					<LandingTradingToolImage class="sm:hidden" />
					<div data-aos="fade-right" class="col-span-12 lg:col-span-6 space-y-8 sm:space-y-10 px-4 sm:px-6 mt-10">
						<h2 class="text-4xl font-semibold">Advanced <span class="text-header-gradient font-bold">ANALYTICS</span>, Charts and Reports
						</h2>
						<div class="space-y-2">
							<h4 class="text-lg font-medium">Detailed Breakdown, Non-stop Availability</h4>
							<p class="paragraph text-sm xl:text-base">
								Storm Sacco Management System provides you with a comprehensive overview of its transactions and loan data recorded inthe system. It offers detailed breakdowns of each transaction, including the type, amount, date and status. Additionally, it has graphical charts to help visualize the data in an easy-to-understand format. This allows you to quickly identify certain trends make informed decisions about how best to manage your sacco going forward.
							</p>
						</div>
						<div class="flex flex-col sm:flex-row">
							<BaseButton
								class="max-w-full px-8 py-4 bg-gradient-to-r from-[#468ef9] to-[#0c66ee] border border-[#0c66ee] text-white">
								Features
							</BaseButton>
						</div>
					</div>
					<LandingTradingToolImage data-aos="fade-left" class="hidden sm:block" />
				</div>
			</section>

			<!-- Industry-leading security section -->
			<section class="w-full my-24">
				<div class="relative max-w-screen-xl px-8 mx-auto grid grid-cols-12 gap-x-6">
					<div data-aos="fade-right" class="col-span-12 lg:col-span-6">
						<div class="w-full">
							<img src="../../img/industry-leading-security.webp" class="w-full" alt="" />
						</div>
					</div>
					<div data-aos="fade-left" class="col-span-12 lg:col-span-5 space-y-8 sm:space-y-6 mt-8 xl:px-8">
						<h2 class="text-4xl font-semibold">Industry-leading security from day one</h2>
						<p class="paragraph">
							Storm Sacco Management System utilizes the latest encryption technologies to ensure that all funds deposited into the platform remain secure and protected. All transactions are monitored in real-time, with multi-factor authentication protocols in place to verify identity and prevent fraudulent activity.
						</p>
						<p class="paragraph">
							Furthermore, all deposits are stored on a secure server with multiple layers of security measures designed to protect user data from unauthorized access or malicious attack. By utilizing these cutting edge security features, my app is able to guarantee both the safety and integrity of any funds deposited onto our platform.
						</p>
					</div>
				</div>
			</section>

			<!-- Getting started section -->
			<section
				class="bg-white relative max-w-full sm:mx-4 xl:mx-10 my-24 shadow sm:rounded-2xl overflow-hidden">
				<div class="w-full py-16 flex flex-col items-center">
					<h2 data-aos="flip-down" class="text-3xl sm:text-4xl font-semibold text-center">
						Get started in just a few minutes
					</h2>
					<div data-aos="fade-up"
						class="relative w-full flex flex-col lg:flex-row items-center justify-between space-y-12 lg:space-y-0 px-4 xl:px-10 mt-16 sm:mt-8">
						<LandingStep v-for="step in steps" :key="step.title" :step="step" />
						<img src="../../img/getting-started/arrow.png"
							class="hidden lg:inline-block absolute top-32 left-64 xl:left-[22rem] w-24 xl:w-[9.5rem]"
							alt="" />
						<img src="../../img/getting-started/arrow.png"
							class="hidden lg:inline-block absolute top-32 right-64 xl:right-[22rem] w-24 xl:w-[9.5rem]"
							alt="" />
					</div>
				</div>
			</section>

			<!-- FAQ section -->
			<section class="w-full my-24">
				<BaseSection>
					<div data-aos="fade-right" data-aos-delay="150" class="col-span-12 lg:col-span-6">
						<div class="w-full">
							<img src="../../img/faq.webp" class="w-full" alt="" />
						</div>
					</div>
					<div data-aos="fade-left" data-aos-delay="150" class="col-span-12 lg:col-span-6 px-4 sm:px-6 mt-8">
						<span class="text-base text-gradient font-semibold uppercase mb-4 sm:mb-2">Support</span>
						<h2 class="text-3xl sm:text-4xl font-semibold mb-10 sm:mb-6">Frequently asked questions</h2>

						<ul class="shadow-box">
							<BaseAccordion v-for="(accordion, index) in accordions" :key="index" :accordion="accordion" />
						</ul>
					</div>
				</BaseSection>
			</section>

			<div class="w-full my-10 flex justify-center">
				<a v-smooth-scroll data-aos="flip-down" data-aos-delay="150" href="#navbar"
					class="px-6 py-3 flex items-center space-x-2 bg-[#FAFAFA] hover:bg-gray-100 hover:shadow-md border border-[#DDDDDD] rounded-md text-gray-700">
					<span>Back to top</span>
				</a>
			</div>
		</div>
	</AppLayout>
</template>
	
<script>
import aosMixin from '@/Mixins/aos'
export default {
	name: 'IndexPage',
	mixins: [aosMixin],
	data() {
		return {
			selected: 0,
			dropdownConcurency: false,
			dropdownCrypto: false,
			currencySelected: {
				img: 'country-icon/eng.png',
				name: 'USD',
			},
			currencies: [
				{
					img: 'country-icon/eng.png',
					name: 'USD',
				},
			],
			cryptoSelected: {
				img: 'crypto-icon/bitcoin.png',
				name: 'BTC',
			},
			cryptocurrencies: [
				{
					img: 'crypto-icon/bitcoin.png',
					name: 'BTC',
				},
			],
			trendings: [
				{
					id: 1,
					name: 'Bitcoin',
					price: 43180.13,
					logo: 'bitcoin.png',
					increase: true,
					data: [40, 35, 60, 75, 60, 75, 50],
				},
				{
					id: 2,
					name: 'Ethereum',
					price: 3480.65,
					logo: 'ethereum.png',
					increase: false,
					data: [25, 30, 60, 50, 80, 55, 80],
				},
				{
					id: 3,
					name: 'Solana',
					price: 150.2,
					logo: 'solana.png',
					increase: true,
					data: [40, 45, 40, 80, 50, 60, 35],
				},
				{
					id: 4,
					name: 'Dogecoin',
					price: 0.1572,
					logo: 'dogecoin.png',
					increase: true,
					data: [35, 70, 60, 80, 50, 60, 40],
				},
			],
			topGainers: [
				{
					id: 1,
					name: 'PAPPAY',
					price: 0.00374,
					logo: 'pappay.png',
					increase: true,
					data: [30, 50, 45, 60, 70, 40, 45],
				},
				{
					id: 2,
					name: 'Bitcoin Asia',
					price: 0.02096,
					logo: 'bitcoin-asia.png',
					increase: true,
					data: [25, 60, 50, 60, 35, 50, 70],
				},
				{
					id: 3,
					name: 'MoonRock',
					price: 0.004907,
					logo: 'moonrock.png',
					increase: true,
					data: [40, 35, 40, 25, 50, 70, 45],
				},
				{
					id: 4,
					name: 'NinjaFloki',
					price: 0.000123,
					logo: 'ninjafloki.png',
					increase: true,
					data: [45, 35, 40, 30, 25, 45, 35],
				},
			],
			recents: [
				{
					id: 1,
					name: 'MetaCraft',
					price: 0.0608,
					logo: 'metacraft.png',
					increase: false,
					data: [40, 50, 45, 60, 35, 40, 45],
				},
				{
					id: 2,
					name: 'Frog',
					price: 0.5875,
					logo: 'frog.png',
					increase: false,
					data: [25, 50, 45, 48, 40, 60, 45],
				},
				{
					id: 3,
					name: 'Musk Doge',
					price: 0.04041,
					logo: 'musk-doge.png',
					increase: true,
					data: [25, 35, 60, 45, 50, 45, 45],
				},
				{
					id: 4,
					name: '2SHARE',
					price: 1366.24,
					logo: '2share.png',
					increase: true,
					data: [35, 30, 60, 50, 35, 45, 40],
				},
			],
			accordions: [
				{
					title: 'Why should I choose NEFA?',
					description:
						"We're industry pioneers, having been in the cryptocurrency industry since 2016. We've facilitated more than 21 billion USD worth of transactions on our exchange for customers in over 40 countries. Today, we're trusted by over 8 million customers around the world and have received praise for our easy-to-use app, secure wallet, and range of features.",
				},
				{
					title: 'How secure is NEFA?',
					description:
						"We're industry pioneers, having been in the cryptocurrency industry since 2016. We've facilitated more than 21 billion USD worth of transactions on our exchange for customers in over 40 countries. Today, we're trusted by over million customers around the world and have received praise for our easy-to-use app, secure wallet, and range of features.",
				},
				{
					title: 'Do I have to buy a whole Bitcoin?',
					description:
						"We're industry pioneers, having been in the cryptocurrency industry since 2016. We've facilitated more than 21 billion USD worth of transactions on our exchange for customers in over 40 countries. Today, we're trusted by over million customers around the world and have received praise for our easy-to-use app, secure wallet, and range of features.",
				},
				{
					title: 'How do I actually buy Bitcoin?',
					description:
						"We're industry pioneers, having been in the cryptocurrency industry since 2016. We've facilitated more than 21 billion USD worth of transactions on our exchange for customers in over 40 countries. Today, we're trusted by over million customers around the world and have received praise for our easy-to-use app, secure wallet, and range of features.",
				},
			],
			steps: [
				{
					img: 'order.png',
					title: 'Order App',
					description:
						'Sign up for your free 30-Days free trial of choose a premium package and order Storm Sacco Management System.',
				},
				{
					img: 'setup.png',
					title: 'Setup & Activate',
					description:
						'After receiving your installation, set it up and activate it using the key provided to you. This process is automatic',
				},
				{
					img: 'use.png',
					title: 'Enjoy!',
					description:
						'After successfull activation, the application will be all yours to use. Feel free to give feedback too! We continue updating the app.',
				},
			],
		}
	},
}
</script>
<style scoped>
.text-header-gradient {
	background: rgb(57, 132, 244);
	background: linear-gradient(169.4deg, #3984f4 -6.01%, #0cd3ff 36.87%, #2f7cf0 78.04%, #0e65e8 103.77%);
	background-clip: text;
	-webkit-text-fill-color: transparent;
}
</style>	