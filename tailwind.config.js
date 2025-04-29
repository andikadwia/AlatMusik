/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#a08963",
                secondary: "#d9d9d9",
                accent: "#fffcf9",
                neutral: "#f5f5f5",
                "base-100": "#ffffff",
                "base-content": "#000000",
                error: "#e03939",
            },
            fontFamily: {
                sans: ["Poppins", "sans-serif"],
                roboto: ["Roboto", "sans-serif"],
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};
