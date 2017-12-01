<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
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
    import message_form from './MessageToUser/MessageForm.vue';
    import message_list from './MessageToUser/MessageList.vue'

    export default {
        data(){
            return {
                message: "",
                messages: [],
                users: [],
            }
        },

        methods: {},

        mounted() {
            Echo.private("message-to-user-channel")
                .listen(".message-to-user-event", (data) => {
                    this.messages.push(data);
                });

            // select box に使うユーザを取得
            axios.get('/get-all-users')
                .then(response => {
                    this.users = response.data;
                })
        },

        components: {
            message_form: message_form,
            message_list: message_list
        }
    }
</script>