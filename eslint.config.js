import js from '@eslint/js';
import typescriptEslint from '@typescript-eslint/eslint-plugin';
import tsParser from '@typescript-eslint/parser';
import pluginImport from 'eslint-plugin-import-x';
import pluginVue from 'eslint-plugin-vue';
import globals from 'globals';
import vueParser from 'vue-eslint-parser';

const importOrderRules = {
    'import/order': [
        'error',
        {
            groups: [
                'builtin',
                'external',
                'internal',
                'parent',
                'sibling',
                'index',
                'object',
                'type',
            ],
            'newlines-between': 'always',
            alphabetize: {
                order: 'asc',
                caseInsensitive: true,
            },
        },
    ],
};

export default [
    {
        ignores: [
            '**/build/**',
            '**/public/build/**',
            '**/node_modules/**',
            '**/vendor/**',
            'resources/js/admin.js',
            '**/*.d.ts',
        ],
    },
    js.configs.recommended,
    // JavaScript/TypeScript files
    {
        files: ['**/*.{js,ts}'],
        languageOptions: {
            globals: {
                ...globals.browser,
                TypiCMS: 'readonly',
                emitter: 'readonly',
                setItemsHeight: 'readonly',
                registerMasonry: 'readonly',
                RequestInit: 'readonly',
                NodeListOf: 'readonly',
                ChildNode: 'readonly',
            },
            parser: tsParser,
            parserOptions: {
                ecmaVersion: 'latest',
                sourceType: 'module',
            },
        },
        plugins: {
            '@typescript-eslint': typescriptEslint,
            import: pluginImport,
        },
        rules: importOrderRules,
    },
    // Vue files
    ...pluginVue.configs['flat/essential'],
    {
        files: ['**/*.vue'],
        languageOptions: {
            globals: {
                ...globals.browser,
                TypiCMS: 'readonly',
                emitter: 'readonly',
            },
            parser: vueParser,
            parserOptions: {
                parser: tsParser,
                ecmaVersion: 'latest',
                sourceType: 'module',
            },
        },
        plugins: {
            '@typescript-eslint': typescriptEslint,
            import: pluginImport,
        },
        rules: {
            ...importOrderRules,
            'vue/attributes-order': 'error',
            'vue/multi-word-component-names': 'off',
        },
    },
];
