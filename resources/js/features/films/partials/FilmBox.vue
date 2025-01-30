<template>
    <Link :href="route(routes.films.show, item.id)" class="group">
        <img
            :src="item.poster_path"
            :alt="item.original_title"
            class="aspect-square w-full overflow-hidden rounded-lg object-cover group-hover:opacity-75 sm:aspect-[2/3]"
        />

        <p class="mt-1 text-sm text-white/60 text-center">{{ item.name }}</p>
    </Link>
</template>

<script setup>
import { routes } from '@/routes';
import { Link } from '@inertiajs/vue3';

defineProps({
    item: Object,
});
</script>
