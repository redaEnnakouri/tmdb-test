export const useDebounce = (wait = 300) => {
    return (func) => {
        let timeout;
        return function (...args) {
            const context = this;
            if (timeout) clearTimeout(timeout);
            timeout = setTimeout(() => {
                timeout = null;
                func.apply(context, args);
            }, wait);
        };
    };
};
