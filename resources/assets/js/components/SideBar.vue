<template>
    <div id="sidebar-main" class="sidebar sidebar-default sidebar-separate sidebar-fixed">
        <div class="sidebar-content">
            <!-- /Sidebar Category -->
            <div class="sidebar-category sidebar-default">

                <div class="category-content">
                    <ul id="fruits-nav" class="nav flex-column">
                        <li class="nav-item" v-for="nav in navs">
                            <a href="#" v-on:click.prevent="$emit('getData', nav.ref)" class="nav-link" >
                                <span v-html="nav.icon"></span>
                                {{nav.title}}
                            </a>
                        </li>


                    </ul>
                    <!-- /Nav -->
                </div>
                <!-- /Category Content -->
            </div>
            <!-- /Sidebar Category -->

        </div>
    </div>
</template>

<script>
    import Bar from './Bar';
    export default {
        data(){
            return {
                navs: [
                    {
                        ref: 'home',
                        icon: '<svg class="olymp-newsfeed-icon left-menu-icon mr-2" data-toggle="tooltip" data-placement="right" data-original-title="NEWSFEED"><use xlink:href="svg-icons/sprites/icons.svg#olymp-newsfeed-icon"></use></svg>',
                        title: 'Beranda'
                    },
                    {
                        ref: 'berita',
                        icon: '<svg class="olymp-chat---messages-icon mr-2"><use xlink:href="svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>',
                        title: 'Berita'
                    },
                    {
                        ref: 'kanal',
                        icon: '<svg class="olymp-happy-faces-icon left-menu-icon mr-2" data-toggle="tooltip" data-placement="right" data-original-title="FRIEND GROUPS"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-faces-icon"></use></svg>',
                        title: 'Kanal Desa'
                    }
                ],
                status: [],
                places: 'home',
                loadingBar: false
            }
        },
        mounted() {

        }
    }
</script>
