/** @type {import('tailwindcss').Config} */
module.exports = {
    corePlugins: {
        preflight: false,
    },
    prefix: 'tob-',
    content: ["./src/TowerOfBabel/Templates/**/*.html.php"],
    theme: {
        extend: {},
    },
    plugins: [],
}

