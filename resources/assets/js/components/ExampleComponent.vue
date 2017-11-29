<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">Message</div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Form
                                    </div>
                                    <div class="panel-body">
                                        <div class="form form-horizontal" >
                                            <!-- select box -->
                                            <!--<div class="form-group">-->
                                                <!--<label class="label label-control sol-sm-1">to user</label>-->
                                            <!--</div>-->
                                            <!--<div class="col-sm-2">-->
                                            <!--</div>-->

                                            <div class="form-group">
                                                <label class="control-label col-sm-1">Message</label>
                                                <div class="col-sm-10">
                                                    <input type="text" v-model="message" class="form-control" placeholder="message">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-1 col-sm-2">
                                                    <button class="btn btn-primary" @click="send()">Send</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Messages
                                    </div>
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            <li class="list-group-item" v-for="item in messages">{{ item.message }} - {{ item.user }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        data(){
            return {
                messages: [],
                message: '',
            }
        },

        methods: {
            send() {
                axios.post('/message', {message: this.message})
                    .then((response) => {
                        this.message = '';
                    });
            }
        },

        mounted() {
            Echo.channel("message-channel")
                .listen(".message-event", (data) => {
                    this.messages.push(data);
                });
        }
    }
</script>