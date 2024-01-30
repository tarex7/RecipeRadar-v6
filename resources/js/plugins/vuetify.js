// resources/js/plugins/vuetify.js
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

import colors from 'vuetify/util/colors'

export default createVuetify({
    components,
    directives,
    theme: {
        themes: {
            light: {
                dark: false,
                colors: {
                    primary: '#E53935', // Rosso Pomodoro
                    secondary: '#388E3C', // Verde Basilico
                    accent: '#FDD835', // Giallo Zafferano
                    info: '#6D4C41', // Marrone Cioccolato
                    success: '#388E3C', // Puoi usare il Verde Basilico anche per il successo
                    warning: '#F57C00', // Arancione (alternativa per warning)
                    error: '#D32F2F', // Rosso scuro (alternativa per error)
                    anchor: '#8E8E8E', // Maingrey per i link

                }
            },
        },
    },
})
