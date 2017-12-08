<template>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Messages
                        <div class="text-right">
                            <p>未読メッセージ <span class="alert">{{ unreadCount }}</span> 件</p>
                        </div>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="message in messages">
                                <a @click="changeReadStatus(message)">
                                    <span class="glyphicon glyphicon-envelope" v-bind:class="{'glyphicon-envelope': !message.readStatus, 'glyphicon-repeat': message.readStatus}"></span>
                                </a>
                                {{ message.message }} - {{ message.fromUser.name }} -
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'messages',
        ],

        data() {
            return {
                unreadMessage: ""
            }
        },

        computed: {
            unreadCount() {
                let count = 0;
                if (this.messages.length) {
                    this.messages.forEach(function (message) {
                        if (!message.readStatus) {
                            count += 1;
                        }
                    });
                }
                return count;
            }
        },

        methods: {
            changeReadStatus(message) {
                axios.put('/change-read-status', {message: message})
                    .then((response) => {
                        message.readStatus = !message.readStatus;
                    });
            },
        }
    }
</script>