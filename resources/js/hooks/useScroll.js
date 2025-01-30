import { ref, onMounted, onBeforeUnmount } from 'vue';
import { useDebounce } from '@/hooks';

export function useScroll(debounceTime = 10, threshold = 10) {
    const isAtBottom = ref(false);

    const debounceScroll = useDebounce(debounceTime);

    const onScroll = debounceScroll(() => {
        const scrollHeight = document.documentElement.scrollHeight;
        const scrollTop = window.scrollY;
        const windowHeight = window.innerHeight;

        if (scrollHeight - scrollTop - windowHeight < threshold) {
            isAtBottom.value = true;
        } else {
            isAtBottom.value = false;
        }
    });

    onMounted(() => {
        window.addEventListener('scroll', onScroll);
    });

    onBeforeUnmount(() => {
        window.removeEventListener('scroll', onScroll);
    });

    return {
        isAtBottom,
    };
}
