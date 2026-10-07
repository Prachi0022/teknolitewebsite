/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html", // Root HTML file
    "./js/**/*.js", // All JavaScript files in the js folder and subfolders
    "./css/**/*.css" // Optional: All CSS files in the css folder and subfolders
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}