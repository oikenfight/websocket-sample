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
                    <message_form></message_form>
                    <message_list :messages="messages"></message_list>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import user_status_sidebar from './Message/UserStatusSidebar.vue';
    import message_form from './Message/MessageForm.vue';
    import message_list from './Message/MessageList.vue';

    export default {
        data() {
            return {
                authUser: [],
                message: "",
                messages: [],
                users: {},
            };
        },

        components: {
            user_status_sidebar: user_status_sidebar,
            message_form: message_form,
            message_list: message_list
        },

        created() {
            // TODO: .vue ファイルでログインユーザを使いたいが、blade のようにいかず api 経由で取得しているため、いい方法ないか調べる
            axios.get('/get-auth-user')
                .then(response => {
                    const authUser = response.data;
                });

            // sidebar 用に全ユーザを取得
            axios.get('/get-all-users')
                .then(response => {
                    this.users = response.data;
                });
        },

        beforeMount() {
            // channel を繋いで自分宛ての event をリッスンする
            Echo.channel("status-control-channel")
                .listen(".call-event", (data) => {
                    // このイベントを受け取ったユーザは online であることを broadcast で知らせる
                    axios.post('/message/callback')
                        .then((data) => {
                            console.log('callback now');
                        });
                })
                .listen(".callback-event", (data) => {
                    // call-event に対して、online のユーザが callback してくる
                    this.users[data.userId].online = true;
                    console.log('callback coming from ' + data.userId);
                });

            // TODO: 各メッセージを受け取れるようにする
//            Echo.private("message-channel")
//                .listen(".message-event" + this.authUser.id, (data) => {
//                    // 全体への message が流れてくる
//                    this.messages.push(data);
//                })
//                .listen(".message-to-groups-event" + this.authUser.group, (data) => {
//                    // group 宛の message が流れてくる
//                    this.messages.push(data);
//                })
//                .listen(".message-to-users-event." + this.authUser.id, (data) => {
//                    // 自分宛ての message が流れてくる
//                    this.messages.push(data);
//                });
        },

        mounted() {
            // online-control-channel にイベントを発生させて応答を待つ
            axios.post('/message/call')
                .then((response) => {
                    console.log('call first');
                });
        },

        beforeDestroy() {
            alert('really exit ?');
        },

        methods: {},
    };
</script>