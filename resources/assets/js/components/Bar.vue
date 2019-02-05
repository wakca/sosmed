<template>
    <ul id="fruits-nav" class="nav flex-column">
        <li class="nav-item" v-for="data in dataList">
            <a href="#" class="nav-link">
                <span v-html="data.icon"></span>
                {{data.title}}
            </a>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['dataList'],
        mounted() {
        }
    }
</script>
