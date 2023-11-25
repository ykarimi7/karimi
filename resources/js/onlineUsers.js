require("./bootstrap");
import { createApp } from "vue";
import OnlineUsersComponent from './components/OnlineService.vue';

import Echo from "laravel-echo";

window.Pusher = require("pusher-js");
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '344a98e76580e73452e6',
    cluster: 'eu',
    forceTLS: true
});


createApp(OnlineUsersComponent).mount("#header-container");