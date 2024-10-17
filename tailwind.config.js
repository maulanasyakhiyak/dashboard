/** @type {import('tailwindcss').Config} */
export default {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
       "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        container: {
            center: true,
            padding: '1rem',
          },
    },
    plugins: [
      require('flowbite/plugin')
    ],
  }
