<script setup>
import { ref, useAttrs } from 'vue';
import { MagnifyingGlassIcon, XCircleIcon } from '@heroicons/vue/24/solid';
import { useDebounce } from '@/hooks';
import Spinner from '@/components/Spinner.vue';
defineProps({
    modelValue: String,
    loading: Boolean,
    placeholder: String,
});
const emit = defineEmits(['update:modelValue', 'change']);
const debounce = useDebounce(800);
const attrs = useAttrs();

const isInputFocused = ref(false);
const handleChange = (e) => {
    emit('update:modelValue', e.target.value);
};
const handleSearch = debounce((e) => {
    emit('change', e.target.value);
});
const handleClear = () => {
    emit('update:modelValue', '');
    emit('change', '');
};
// useParams
</script>
<template>
    <div class="flex items-center relative">
        <!-- <div class="relative rounded-md flex-1 flex gap-3 h-full"> -->
        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
            <MagnifyingGlassIcon
                class="h-5 pr-1.5 absolute left-3 top-1/2 -mt-2.5 opacity-70 border-gray-300 fill-current"
            />
        </div>
        <button
            v-if="modelValue"
            :class="{ 'opacity-0': (!isInputFocused || loading) && !modelValue }"
            type="button"
            class="absolute right-2 top-1/2 -mt-2.5"
            @click.stop="handleClear"
        >
            <XCircleIcon class="h-5 pr-1.5 opacity-70 border-gray-300 fill-current" />
        </button>

        <input
            :value="modelValue"
            type="text"
            name="search"
            placeholder="Recherche avec mot-clé"
            class="px-10 bg-transparent block h-full w-full rounded-full border-none py-3 focus:outline-0 focus:ring focus:ring-orange-500"
            v-bind="attrs"
            @input="handleSearch"
            @keyup="handleChange"
            @focus="isInputFocused = true"
            @blur="isInputFocused = false"
        />
        <!-- </div> -->
        <Spinner v-if="loading" class="w-8 absolute right-2 p-1.5 top-1/2 -mt-4 fill-orange-500 text-gray-400" />
    </div>
</template>
