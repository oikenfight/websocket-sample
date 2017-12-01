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
                                    <label class="control-label col-sm-2">to user</label>
                                    <div class="col-sm-9">
                                        <select multiple v-model="selectedUsers" class="form-control">
                                            <option disabled value="">選択してください</option>
                                            <option v-for="user in users" v-bind:value="user.id">
                                                {{ user.name }}
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
            'users',
        ],

        data() {
            return {
                message: "",
                selectedUsers: []
            }
        },

        methods: {
            send() {
                axios.post('/message-to-users', {message: this.message, to_users: this.selectedUsers})
                    .then((response) => {
                        this.message = '';
                        this.selectedUsers = [];
                    });
            }
        }
    }
</script>