<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">Message</div>
                    </div>
                    <message_form :groups="groups"></message_form>
                    <message_list :messages="messages"></message_list>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import message_form from './MessageToGruop/MessageForm.vue';
    import message_list from './MessageToGruop/MessageList.vue'

    export default {
        data(){
            return {
                message: "",
                messages: [],
                groups: [],
            }
        },

        components: {
            message_form: message_form,
            message_list: message_list
        },

        mounted() {
            // TODO: .vue ファイルでログインユーザを使いたいが、blade のようにいかず api 経由で取得しているため、いい方法ないか調べる
            axios.get('/get-auth-user')
                .then(response => {
                    const authUser = response.data;
                    this.echoChannel(authUser)
                });

            // select box に使うユーザを取得
            axios.get('/get-all-groups')
                .then(response => {
                    this.groups = response.data;
                });
        },

        methods: {
            echoChannel(authUser) {
                Echo.private("message-to-group-channel." + authUser.group)
                    .listen(".message-to-group-event", (data) => {
                        this.messages.push(data);
                    });
            }
        },
    }
</script>