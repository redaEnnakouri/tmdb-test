<template>
    <section class="py-24 relative text-white">
        <!-- Backdrop Image -->
        <div class="absolute inset-0">
            <img :src="film.backdrop_path" alt="Backdrop" class="w-full h-dvh object-cover opacity-50 blur-lg" />
            <div class="absolute inset-0 h-dvh bg-gradient-to-b from-red-500/20 to-black/90"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-6 py-16">
            <div class="flex flex-col md:flex-row gap-8 md:gap-x-20">
                <!-- Movie Poster -->
                <div class="flex-shrink-0 w-full md:w-1/3">
                    <img :src="film.poster_path" :alt="film.title" class="rounded-2xl shadow-xl" />
                </div>

                <!-- Movie Details -->
                <div class="flex-1">
                    <h1 class="text-5xl font-bold">{{ film.title }}</h1>
                    <h2 class="text-base text-white/50 mt-1">
                        {{ film.original_title }}
                    </h2>

                    <div class="flex items-center gap-4 pt-8 pb-4">
                        <StarIcon class="text-yellow-400 size-5" aria-hidden="true" /> {{ film.vote_average }}/10
                        <img src="/assets/images/imdb.png" :alt="film.title" class="h-12 -my-2" />
                    </div>
                    <p class="mt-4 text-gray-300">{{ film.overview }}</p>

                    <ul class="mt-6 flex flex-col flex-wrap gap-4">
                        <li class="px-4 py-2 bg-black rounded-lg text-sm w-fit">
                            🗓 Release Date: {{ film.release_date }}
                        </li>
                        <li class="px-4 py-2 bg-black rounded-lg text-sm w-fit">
                            🌍 Language: {{ film.original_language.toUpperCase() }}
                        </li>

                        <li class="px-4 py-2 bg-black rounded-lg text-sm w-fit">💬 Votes: {{ film.vote_count }}</li>
                        <li v-if="film.adult" class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm">
                            🔞 Adult Content
                        </li>
                    </ul>

                    <div class="flex pt-10 gap-8">
                        <SecondaryButton :href="route(routes.films.edit, film.id)">
                            <PencilSquareIcon class="size-6" aria-hidden="true" />
                            Modifier le film
                        </SecondaryButton>

                        <PrimaryButton @click="emit('delete:film')">
                            <TrashIcon class="size-6" aria-hidden="true" />
                            Supprimer le film
                        </PrimaryButton>
                    </div>
                </div>

                <!-- Movie editer -->
            </div>
        </div>
    </section>
</template>

<script setup>
import PrimaryButton from '@/components/PrimaryButton.vue';
import SecondaryButton from '@/components/SecondaryButton.vue';
import { routes } from '@/routes';
import { StarIcon, PencilSquareIcon, TrashIcon } from '@heroicons/vue/20/solid';

const emit = defineEmits(['delete:film']);
defineProps({
    film: Object,
});
</script>
