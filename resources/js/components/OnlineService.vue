<template style="display: none">
  <div>
    <!-- Your component template goes here -->
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
  data() {
    return {
      user: window.user,
      full_time_online: 0,
    };
  },
  methods: {
    setupOnlineUsersListener() {
      window.Echo.join('example')
          .joining((user) => {
            this.handleUserJoining(user);
          })
          .leaving((user) => {
            this.handleUserLeaving(user);
          });
    },
    handleUserJoining(user) {
      // console.log('User Joined:', user);
      axios.post('/api/user/online', {
        userId: user.id,
      });
    },
    handleUserLeaving(user) {
      // console.log('User Left:', user);
      axios.post('/api/user/offline', {
        userId: user.id,
      });
    },
  },
  created() {
    this.setupOnlineUsersListener();
  },
  setup() {
    onMounted(() => {
    });
  },
};
</script>

<style>
</style>
