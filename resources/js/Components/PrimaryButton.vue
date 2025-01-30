<script setup>
import { Link } from '@inertiajs/vue3';
import Spinner from './Spinner.vue';

defineProps({
    type: {
        type: String,
        default: 'submit',
    },
    href: [String, null],
    processing: Boolean,
});
</script>

<template>
    <component
        :is="href ? Link : 'button'"
        :href="href ? href : null"
        :type="type"
        :disabled="processing"
        class="relative rounded-full py-2 px-4 md:px-8 bg-orange-500 text-white gap-5 hover:opacity-70 disabled:opacity-25 active:bg-orange-700 transition-all"
    >
        <span v-if="processing" class="absolute inset-0 flex items-center justify-center">
            <Spinner class="w-5 h-5 fill-black" />
        </span>
        <span :class="['flex items-center', processing ? 'opacity-0' : 'opacity-100']">
            <slot />
        </span>
    </component>
</template>
