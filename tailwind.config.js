/** @type {import('tailwindcss').Config} */
const withMT = require("@material-tailwind/html/utils/withMT");

module.exports = withMT({
  content: ["./resources/**/*.blade.php"],
  theme: {
    extend: {},
  },
  plugins: [],
});

// module.exports = {
//   content: [
//     "./resources/**/*.blade.php",
//     "./resources/**/*.js",
//     "./resources/**/*.vue"
//   ],
//   theme: {
//     extend: {},
//   },
//   plugins: [],
// }
