<template>
    <section class="relative z-1">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 id="list-heading" class="sr-only">list</h2>
            <div class="grid gap-x-4 gap-y-10 grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:gap-x-8">
                <FilmBox v-for="item in films.data" :key="item.id" :item="item" />
            </div>
            <div class="flex justify-center mt-16">
                <Spinner v-if="films.fetchingMore" class="w-8 text-white fill-orange-500" />
                <div v-else-if="films.meta.total === 0" class="text-white flex flex-col items-center justify-center">
                    <ExclamationTriangleIcon class="h-12 w-12 text-orange-500" />
                    <span>Il n'y a pas de film</span>
                </div>
                <span v-else-if="films.meta.last_page === films.meta.current_page" class="text-white/60">
                    Tu atteins la fin
                </span>
            </div>
        </div>
    </section>
</template>

<script setup>
import Spinner from '@/components/Spinner.vue';
import FilmBox from './FilmBox.vue';
import { ExclamationTriangleIcon } from '@heroicons/vue/24/outline';

const props = defineProps({
    films: Object,
});
</script>
