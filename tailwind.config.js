/** @type {import('tailwindcss').Config} */
// import colors from "tailwindcss/colors";
// import forms from "@tailwindcss/forms";
// import typography from "@tailwindcss/typography";

// export default {
//     content: ["./resources/**/*.blade.php", "./vendor/filament/**/*.blade.php"],
//     theme: {
//         extend: {},
//     },
//     plugins: [],
// };

import colors from "tailwindcss/colors";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

export default {
    content: ["./resources/**/*.blade.php", "./vendor/filament/**/*.blade.php"],
    safelist: ["bg-red-500"],
    darkMode: "class",
    theme: {
        container: {
            center: true,
            padding: "1rem",
        },
        extend: {
            colors: {
                danger: colors.rose,
                primary: colors.blue,
                success: colors.green,
                warning: colors.yellow,
            },
        },
    },
    plugins: [forms, typography],
};
