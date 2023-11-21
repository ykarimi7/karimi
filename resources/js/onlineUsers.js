import axios from "axios";
import Echo from

        "laravel-echo";

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Pusher = require('pusher-js');
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '968f75d1df558e96b55f',
    cluster: 'eu',
    forceTLS: true
});

let user = {
    id: window.userId,
    full_time_online: 0,
};

window.Echo.join('example')
    .on('userConnected', (user) => {
        if (user.id === window.userId) {
            // User connected
            console.log('user connected');
            // axios.post('/api/users/online', {
            //     userId: window.userId,
            // });
        }
    })
    .on('userDisconnected', (user) => {
        if (user.id === window.userId) {
            console.log('user DesConnected');

        }
    });

// const handleUserJoinLeave = () => {
//     const currentTime = new Date().getTime();
//
//     if (user.lastActivity) {
//         const timeDifference = currentTime - user.lastActivity;
//         user.full_time_online += timeDifference;
//         user.lastActivity = currentTime;
//     } else {
//         user.lastActivity = currentTime;
//     }
// };

// window.Echo.join('example')
//     .joining(() => {
        // handleUserJoinLeave();
        // if (user.api_token) {
        //     axios.post('/update-online-status', {
        //         full_time_online: user.full_time_online,
        //     }, {
        //         headers: {
        //             'Authorization': `Bearer ${user.api_token}`,
        //         },
        //     });
        // } else {
        //     console.warn('Missing user API token');
        // }
    // })
    // .leaving(() => {
        // handleUserJoinLeave();
        // if (user.api_token) {
        //     axios.post('/update-online-status', {
        //         full_time_online: user.full_time_online,
        //     }, {
        //         headers: {
        //             'Authorization': `Bearer ${user.api_token}`,
        //         },
        //     });
        // } else {
        //     console.warn('Missing user API token');
        // }
    // });