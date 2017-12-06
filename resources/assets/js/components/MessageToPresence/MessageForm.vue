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
</template>

<script>
    export default {
        data() {
            return {
                message: ""
            }
        },

        methods: {
            send() {
                axios.post('/message', {message: this.message})
                    .then((response) => {
                        this.message = '';
                    });
            }
        }
    }
</script>