<template>
    <li class="nav-item dropdown custom-dropdown mt-2 mr-2">
        <span class="badge badge-primary" style="padding: 5px; border-radius: 50%; position: absolute; top: -3px; right: 0;">
            {{ newNotifications.length <= 9 ? newNotifications.length : '9+' }}
        </span>
        <a class="nav-link dropdown-toggle" href="#" id="userDropDown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="user-name d-block">
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell "><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right custom-dropdown-menu p-0" aria-labelledby="userDropDown" style="padding: 0.5rem 0 !important;">
            <h2 class="dropdown-header pt-0 pb-0 font-weight-bold">Notifications</h2>
            <div class="dropdown-divider"></div>
            <div style="height: 290px; overflow-y: auto;">
                <notification-item-component v-for="notification in newNotifications" :notification="notification" :key="notification.id"></notification-item-component>
            </div>
        </div>
    </li>
</template>

<script>
    import NotificationItemComponent from './NotificationItemComponent.vue';
    export default {
        props: ['notifications', 'userid'],
        components: { NotificationItemComponent },
        data() {
            return {
                newNotifications: this.notifications
            }
        },
        mounted() {
            Echo.private('App.User.' + this.userid)
                .notification((notification) => {
                    let moreNotifications = { data: { messages: notification.messages, user_id: notification.user_id, user_name: notification.user_name }, id: notification.id };
                    this.newNotifications.unshift(moreNotifications);
                });
        }
    }
</script>
