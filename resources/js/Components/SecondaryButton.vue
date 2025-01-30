<script setup>
import { Link } from '@inertiajs/vue3';
import Spinner from './Spinner.vue';

defineProps({
    type: {
        type: String,
        default: 'button',
    },
    href: String,
    processing: Boolean,
});
</script>

<template>
    <component
        :is="href ? Link : 'button'"
        :href="href ? href : null"
        :type="type"
        class="rounded-full py-2 px-4 md:px-8 bg-white text-black flex items-center gap-5 hover:opacity-70 disabled:opacity-25 active:bg-gray-200 transition-all"
    >
        <span v-if="processing" class="absolute inset-0 flex items-center justify-center">
            <Spinner class="w-5 h-5" />
        </span>
        <span :class="['contents', processing ? 'opacity-0' : 'opacity-100']">
            <slot />
        </span>
    </component>
</template>
