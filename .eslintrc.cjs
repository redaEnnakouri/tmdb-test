module.exports = {
    root: true,
    env: {
        node: true,
        browser: true,
    },
    extends: [
        'eslint:recommended',
        'plugin:vue/vue3-recommended',
        'prettier', // Disables ESLint rules that conflict with Prettier
    ],
    plugins: ['vue', 'prettier'],
    rules: {
        'prettier/prettier': 'error', // Shows Prettier errors as ESLint errors
        'vue/multi-word-component-names': 'off', // Disable naming rule if necessary
    },
};
