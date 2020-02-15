<template>
    <li class="nav-item dropdown custom-dropdown mt-2 mr-2">
        <span class="badge badge-primary" style="padding: 5px; border-radius: 50%; position: absolute; top: -3px; right: 0;" v-if="unreadNotifications.length <= 9">
            {{ unreadNotifications.length }}
        </span>
        <span class="badge badge-primary" style="padding: 5px; border-radius: 50%; position: absolute; top: -3px; right: 0;" v-else>
            {{ '9+' }}
        </span>
        <a class="nav-link dropdown-toggle" href="#" id="userDropDown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @click="markNotificationAsRead">
            <span class="user-name d-block">
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell "><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right custom-dropdown-menu p-0 border-0" aria-labelledby="userDropDown" style="box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.25);">
            <div class="notification-header text-center">
                <h2 class="dropdown-header pt-0 pb-0 font-weight-bold" style="color: #fff;">{{ unreads.length }} unread</h2>
                <h4 class="m-0" style="color: #fff;">All notifications</h4>
            </div>
            <div class="dropdown-divider m-0"></div>
            <div style="max-height: 290px; overflow-y: auto;">
                <notification-item-component v-for="notification in newNotifications" :notification="notification" :key="notification.id"></notification-item-component>
            </div>
        </div>
    </li>
</template>

<script>
    import NotificationItemComponent from './NotificationItemComponent.vue';
    export default {
        props: ['notifications', 'userid', 'unreads'],
        components: { NotificationItemComponent },
        data() {
            return {
                unreadNotifications: this.unreads,
                newNotifications: this.notifications
            }
        },
        methods: {
            markNotificationAsRead() {
                if (this.unreadNotifications.length) {
                    axios.get('/mark-as-read');
                }
            }
        },
        mounted() {
            Echo.private('App.User.' + this.userid)
                .notification((notification) => {
                    let moreNotifications = { data: { messages: notification.messages, user_id: notification.user_id, user_name: notification.user_name }, id: notification.id };
                    this.newNotifications.unshift(moreNotifications);
                    this.unreadNotifications.unshift(moreNotifications);
                });
        }
    }
</script>
