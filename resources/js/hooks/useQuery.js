import { onMounted, reactive, ref } from 'vue';

export function useQuery(props = {}, isMounted = false) {
    const { url = '', params = null, init = {} } = props;
    const state = reactive({
        data: init.data || [],
        meta: init.meta || { total: 0, current_page: 1, per_page: 10, links: [] },
        params: params || {},
        fetching: false,
        fetchingMore: false,
        error: null,
        fetch: handleFetch,
        fetchNext: () => handleFetch('', {}, true),
    });

    const controller = ref(null);

    async function handleFetch(_url = '', _params = {}, loadmore = false) {
        if (state.fetching || state.fetchingMore || (loadmore && !state.meta?.next_page_url)) {
            return;
        }
        if (controller.value) {
            controller.value.abort();
        }

        const payload = { ...state.params, ..._params };
        if (loadmore) {
            payload.page = (state.meta?.current_page || 1) + 1;
            state.fetchingMore = true;
        } else {
            state.fetching = true;
        }

        controller.value = new AbortController();

        try {
            const response = await axios.get(_url || url, {
                params: payload,
                signal: controller.value.signal,
            });

            const { data, ...meta } = response.data;
            state.meta = meta;
            state.data = loadmore ? [...state.data, ...(data ?? [])] : (data ?? []);
            return state.data;
        } catch (error) {
            console.error('Error fetching data:', error);
            state.error = error;
            return error;
        } finally {
            state.fetching = false;
            state.fetchingMore = false;
        }
    }

    onMounted(() => {
        if (isMounted && url) {
            handleFetch();
        }
    });

    return state;
}
