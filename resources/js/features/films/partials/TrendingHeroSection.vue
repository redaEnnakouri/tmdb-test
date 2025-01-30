<template>
    <section class="relative -mb-80 z-0">
        <!-- Background Image with Fade Effect -->
        <div
            class="absolute inset-0 z-0 bg-cover bg-center"
            :style="{ backgroundImage: 'url(/assets/images/background.jpg)' }"
        >
            <div class="absolute inset-0 bg-gradient-to-b from-red-500/30 via-black/95 to-black"></div>
        </div>

        <article class="relative isolate overflow-hidden pt-20 pb-80">
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <div class="mx-auto max-w-2xl py-8 sm:py-16 lg:py-28">
                    <div class="text-center">
                        <h1
                            class="text-balance text-4xl md:text-5xl font-semibold tracking-tight text-white sm:text-7xl"
                        >
                            The Movie Everyone’s Talking About
                        </h1>
                        <p class="mt-8 text-pretty text-md font-medium text-gray-300 md:text-xl/8">
                            Join the global conversation. Dive into the trend-setting film that’s breaking records and
                            sparking excitement worldwide.
                        </p>
                        <div class="mt-10 flex flex-col gap-x-6 bg-white/70 rounded-4xl backdrop-blur-sm">
                            <SearchField
                                v-model="films.params.search"
                                @change="films.fetch()"
                                :loading="films.fetching"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
</template>

<script setup>
import SearchField from './SearchField.vue';
const props = defineProps({
    films: Object,
});
</script>
