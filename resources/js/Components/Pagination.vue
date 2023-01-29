<template>
    <div class="flex items-center justify-between border-b rounded-b-xl border-gray-300 bg-white px-4 py-3 sm:px-6">
        <div class="flex flex-1 justify-between sm:hidden">
            <Link 
                :href="data.prev_page_url"
                :preserve-scroll="true"
                :disabled="!prev_page_url"
                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</Link>
                <Link 
                :href="data.next_page_url"
                :preserve-scroll="true"
                :disabled="!next_page_url"
                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</Link>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ data.from }}</span>
                    to
                    <span class="font-medium">{{ data.to }}</span>
                    of
                    <span class="font-medium">{{ data.total }}</span>
                    results
                </p>
            </div>
            <div>
                <nav class="isolate inline-flex space-x-1 rounded-md" aria-label="Pagination">
                    <template v-for="(link, key) in data.links" :key="key">
                        <Link :href="link.url" v-html="link.label" 
                        :preserve-scroll="true"
                        :disabled="!link.active"
                         class="relative inline-flex duration-200 items-center shadow rounded-lg border border-gray-300 bg-white px-[14px] py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20"
                         :class="{ 'bg-blue-600 text-white border-blue-600 hover:bg-blue-700' : link.active }"
                         >
                        </Link>
                    </template>
                </nav>
            </div>
        </div>
    </div>
</template>
<script>
    import { Link } from '@inertiajs/vue3';
    
    export default {
        props:['data'],
        components: {
            Link,
        }
    }
</script>