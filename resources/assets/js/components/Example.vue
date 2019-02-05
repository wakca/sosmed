<template>
    <!-- Main sidebar -->
    <div id="sidebar-main" class="sidebar sidebar-default sidebar-separate sidebar-fixed">
        <div class="sidebar-content">
            <!-- /Sidebar Category -->
            <div class="sidebar-category sidebar-default">
                <div class="category-content">
                    <ul id="fruits-nav" class="nav flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <svg class="olymp-newsfeed-icon left-menu-icon mr-2" data-toggle="tooltip" data-placement="right" data-original-title="NEWSFEED"><use xlink:href="svg-icons/sprites/icons.svg#olymp-newsfeed-icon"></use></svg>
                                Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <svg class="olymp-chat---messages-icon mr-2"><use xlink:href="svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
                                Berita
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <svg class="olymp-happy-faces-icon left-menu-icon mr-2" data-toggle="tooltip" data-placement="right" data-original-title="FRIEND GROUPS"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-faces-icon"></use></svg>
                                Kanal Desa
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
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
