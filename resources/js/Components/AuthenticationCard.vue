<template>
    <div class="h-screen w-full grid grid-cols-4">
        <div class="hidden md:grid col-span-2 overflow-y-hidden min-h-screen">
            <img v-if="route().current('login')" src="../../img/ryoji-iwata-vWfKaO0k9pc-unsplash.jpg" alt="Login Image" class="w-full object-cover">
            <img v-if="route().current('register')" src="../../img/gaudenis-g-JIhlZbUNgns-unsplash.jpg" alt="Login Image" class="w-full object-cover">
            <img v-if="route().current('password.request')" src="../../img/michael-dziedzic-1bjsASjhfkE-unsplash.jpg" alt="Login Image" class="w-full object-cover">
        </div>
        <div class="col-span-4 md:col-span-2">
            <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 bg-gray-100">
                <div>
                    <slot name="logo" />
                </div>

                <div class="w-full mt-10 px-6 py-4 overflow-hidden" :class="route().current('register') ? 'sm:max-w-lg' : 'sm:max-w-md'">
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>
