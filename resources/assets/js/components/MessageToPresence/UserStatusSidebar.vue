<template>
    <div>
        <div>
            <ul class="list-group">
                <li v-for="user in users" class="list-group-item">
                    {{ user.name }}
                    <span class="glyphicon" v-bind:class="{'glyphicon-eye-open': user.online, 'glyphicon-eye-close': !user.online}"></span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'users'
        ],

        data() {
            return {};
        },
    }
</script>