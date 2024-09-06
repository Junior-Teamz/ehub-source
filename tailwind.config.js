/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./resources/**/*.blade.php"],
    theme: {
        extend: {
            boxShadow: {
                'sm': '1px 1px 2px 0 rgba(0, 0, 0, 0.05)',
                'md': '4px 4px 6px -1px rgba(0, 0, 0, 0.1), 2px 2px 4px -2px rgba(0, 0, 0, 0.1)',
                'lg': '10px 10px 15px -3px rgba(0, 0, 0, 0.1), 4px 4px 6px -4px rgba(0, 0, 0, 0.1)',
                'xl': '20px 20px 25px -5px rgba(0, 0, 0, 0.1), 8px 8px 10px -6px rgba(0, 0, 0, 0.1)',
                '2xl': '25px 25px 50px -12px rgba(0, 0, 0, 0.25)',
                '3xl': '35px 35px 60px -15px rgba(0, 0, 0, 0.3)',
            },
            colors: {
                primary: "#1E5163",
                secondary: "#D17707",
                tertiary: "#7EA086",
            },
            backgroundImage: {
                news: "url(/images/news/placeholder.png')",
            },
            screens: {
                'tablet-air': '768px',   // iPad Air
                'tablet-mini': '768px',  // iPad Mini
                'tablet-pro7': '912px',  // Surface Pro 7
                'tablet-duo': '540px',   // Surface Duo unfolded width
                'tablet-fold': '280px',  // Galaxy Fold
                'tablet-a51': '360px',   // Samsung Galaxy A51/71
                'tablet-nest': '410px',  // Nest Hub
                'tablet-nest-max': '480px', // Nest Hub Max
                'sm': '640px',    // Small screens
                'md': '768px',    // Medium screens
                'lg': '1024px',   // Large screens
                'xl': '1280px',   // Extra large screens
                '2xl': '1536px',  // 2x extra large screens
                '3xl': '1792px',  // 3x extra large screens
            },
        },
    },
    plugins: [require("@tailwindcss/forms")],
};
