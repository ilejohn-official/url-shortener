<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <Link href="/url-shortener">
            <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
        </div>

        <div class="md:w-3/4 sm:w-1/2 lg:w-3/5 min-w-1/4 mt-5 px-6 py-8 bg-white shadow-md overflow-hidden rounded-md">
            <slot />
        </div>
    </div>
</template>
