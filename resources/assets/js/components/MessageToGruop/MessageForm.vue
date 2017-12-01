<template>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Form
                    </div>
                    <div class="panel-body">
                        <div class="form form-horizontal" >
                            <div class="form-group">
                                <!--select box -->
                                <div class="form-group">
                                    <label class="control-label col-sm-2">to group</label>
                                    <div class="col-sm-9">
                                        <p>group 選択してみたけけど、自分の group 以外には push できなかった（当然）</p>
                                        <select v-model="selectedGroup" class="form-control">
                                            <option disabled value="">選択してください</option>
                                            <option v-for="group in groups" v-bind:value="group.group">
                                                {{ group.group }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <!-- message input -->
                                <div class="form-group">
                                    <label class="control-label col-sm-2">Message</label>
                                    <div class="col-sm-9">
                                        <input type="text" v-model="message" class="form-control" placeholder="message">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-2">
                                    <button class="btn btn-primary" @click="send()">Send</button>
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
        props: [
            'groups',
        ],

        data() {
            return {
                message: "",
                selectedGroup: ""
            }
        },

        methods: {
            send() {
                axios.post('/message-to-group', {message: this.message, to_group: this.selectedGroup})
                    .then((response) => {
                        this.message = '';
                        this.selectedGroup = '';
                    });
            }
        }
    };
</script>