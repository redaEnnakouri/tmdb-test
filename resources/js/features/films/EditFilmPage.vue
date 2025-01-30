<template>
    <div class="py-32 max-w-7xl mx-auto px-8 text-white">
        <UpdateFilmForm :film="film" />
    </div>
</template>

<script setup>
import { UpdateFilmForm } from './partials';

defineProps({
    film: Object,
});
</script>
