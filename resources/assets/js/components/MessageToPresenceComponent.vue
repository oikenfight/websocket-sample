<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-2 sidebar">
                <div>
                    <user_status_sidebar :users="users"></user_status_sidebar>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">Message</div>
                    </div>
                    <message_form :users="users"></message_form>
                    <message_list :messages="messages"></message_list>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import user_status_sidebar from './MessageToPresence/UserStatusSidebar.vue';
    import message_form from './MessageToPresence/MessageForm.vue';
    import message_list from './MessageToPresence/MessageList.vue';

    export default {
        components: {
            user_status_sidebar: user_status_sidebar,
            message_form: message_form,
            message_list: message_list,
        },

        props: [
            'authUser'
        ],

        data() {
            return {
                message: "",
                messages: [],
                users: {},
            };
        },

        created() {
            // sidebar 用に全ユーザを取得
            axios.get('/get-all-users')
                .then(response => {
                    this.users = response.data;
                });
        },

        mounted() {
            // プレゼンスチャンネルへ参加
            Echo.join('presence-user-channel')
                .here((users) => {
                    users.forEach(function (user) {
                        this.users[user.id].online = true;
                    }, this);
                })
                .joining((user) => {
                    this.users[user.id].online = true;
                })
                .leaving((user) => {
                    this.users[user.id].online = false;
                }).listen('.message-to-presence-users-event.' + this.authUser.id, (data) => {
                    this.messages.push({
                        'message': data.message,
                        'name': data.user.name,
                    });
                });
        },

        methods: {
            showModal () {
                this.$refs.myModalRef.show()
            },
            hideModal () {
                this.$refs.myModalRef.hide()
            }
        },
    };
</script>