<template>
    <article class="hentry post has-post-thumbnail">

        <div class="post__author author vcard inline-items">
            <v-lazy-image :src="'/storage/'+this.props.datapost.user.photo" :alt="this.props.datapost.user.name" v-if="this.props.datapost.user" />

            <img src="img/avatar2-sm.jpg" v-else alt="author">

            <div class="author-date">
                <a class="h6 post__author-name fn" href="#">{{this.props.datapost.user.name}}</a>
                <div class="post__date">
                    <time class="published" datetime="2004-07-24T18:18">
                        {{moment(this.props.datapost.created_at).fromNow()}}
                    </time>
                </div>
            </div>

            <div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                <ul class="more-dropdown">
                    <li>
                        <a href="#">Edit Post</a>
                    </li>
                    <li>
                        <a href="#">Delete Post</a>
                    </li>
                    <li>
                        <a href="#">Turn Off Notifications</a>
                    </li>
                    <li>
                        <a href="#">Select as Featured</a>
                    </li>
                </ul>
            </div>

        </div>

        <p>
            {{this.props.datapost.content}}
        </p>

        <div class="post-thumb" v-if="this.props.datapost.has_image == 'Y'">
            <v-lazy-image :src="'/photos/'+this.props.datapost.photos[0].photo" alt="photo" />
        </div>

        <div class="post-additional-info inline-items">

            <a href="#" class="post-add-icon inline-items">
                <svg class="olymp-heart-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
                <span>{{this.props.datapost.likes.length}}</span>
            </a>


            <div class="comments-shared">
                <a href="#" class="post-add-icon inline-items">
                    <svg class="olymp-speech-balloon-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use></svg>
                    <span>264</span>
                </a>

                <a href="#" class="post-add-icon inline-items">
                    <svg class="olymp-share-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use></svg>
                    <span>37</span>
                </a>
            </div>


        </div>

        <div class="control-block-button post-control-button">

            <a href="#" class="btn btn-control">
                <svg class="olymp-like-post-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-like-post-icon"></use></svg>
            </a>

            <a href="#" class="btn btn-control">
                <svg class="olymp-comments-post-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
            </a>

            <a href="#" class="btn btn-control">
                <svg class="olymp-share-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use></svg>
            </a>

        </div>

    </article>
</template>

<script>
    export default {
        props: {
            "datapost" : Array
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
