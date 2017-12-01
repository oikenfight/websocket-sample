<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
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
    import message_form from './MessageToBloadcast/MessageForm.vue';
    import message_list from './MessageToBloadcast/MessageList.vue'

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
            // channel の event をリッスンする
            Echo.channel("message-channel")
                .listen(".message-event", (data) => {
                    this.messages.push(data);
                });
        },

        components: {
            message_form: message_form,
            message_list: message_list
        }
    }
</script>