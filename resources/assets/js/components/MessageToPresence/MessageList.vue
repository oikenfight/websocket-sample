<template>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Messages
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="item in messages"><a @click="$emit('show')">{{ item.message }} - {{ item.name }}</a></li>
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
            return {}
        },
    }
</script>