
<!-- resources/views/welcome.blade.php -->

// <html>
// <head>
//     <!-- Other head elements -->
//
//     <script>
//         window.userId = {{ auth()->user()->id }};
//     </script>
// </head>
// <body>
// <!-- Your HTML content -->
//
// <script src="{{ mix('js/onlineUsersocket.js') }}"></script>
// </body>
// </html>
//

// resources/js/onlineUsersocket.js

import axios from 'axios';
import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

let user = {
    id: window.userId, // Assuming window.userId is available
    full_time_online: 0, // Initialize the full_time_online attribute
};

const handleUserJoinLeave = () => {
    const currentTime = new Date().getTime();

    if (user.lastActivity) {
        const timeDifference = currentTime - user.lastActivity;
        user.full_time_online += timeDifference;
        // Update the user's last activity timestamp
        user.lastActivity = currentTime;
    } else {
        // Initialize last activity timestamp for the first time
        user.lastActivity = currentTime;
    }
};

window.Echo = new Echo({
    // ... (Your existing Echo configuration)
});

window.Echo.join('chat')
    .joining(() => {
        handleUserJoinLeave();
        axios.post('/update-online-status', {
            full_time_online: user.full_time_online,
        }, {
            headers: {
                'Authorization': `Bearer ${user.api_token}`,
            },
        });
    })
    .leaving(() => {
        handleUserJoinLeave();
        axios.post('/update-online-status', {
            full_time_online: user.full_time_online,
        }, {
            headers: {
                'Authorization': `Bearer ${user.api_token}`,
            },
        });
    });



// npm run dev
// npm run production
// in controller for update fullTime Online
// class UserActivityController extends Controller
// {
//     public function updateOnlineStatus(Request $request)
// {
//     $user = $request->user();
//     $fullTimeOnline = $request->input('full_time_online', 0);
//
//     // Update the user's full_time_online attribute
//     $user->full_time_online = $fullTimeOnline;
//     $user->save();
//
//     return response()->json(['success' => true]);
// }
// }|