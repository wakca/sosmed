<template>
    <div class="row" >
        <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-6 col-12">
            <side-bar v-on:getData="getPage($event)" ></side-bar>

        </aside>
        <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">

            <div id="newsfeed-items-grid">
                <div class="ui-block" v-for="post in postUser">
                    <!-- Post -->

                    <article class="hentry post">

                        <div class="post__author author vcard inline-items">
                            <img :src="post.user.photo ? '/storage/'+post.user.photo : '/photos/av-default.jpg'" :alt="post.user.name">

                            <div class="author-date">
                                <a class="h6 post__author-name fn" href="02-ProfilePage.html">{{post.user.name}}</a>
                                <span v-show="post.receive.id != post.user.id">
                                    >

                                    <a class="h6 post__author-name fn"  href="02-ProfilePage.html">{{post.receive.name}}</a>
                                </span>

                                <div class="post__date">
                                    <i class="text-muted" >
                                        {{moment(post.created_at).local('id').fromNow()}}
                                    </i>
                                </div>
                            </div>

                        </div>

                        <p>
                            <read-more more-str="Lebih Lanjut" :text="post.content" link="#" less-str="Lebih Singkat" :max-chars="250"></read-more>

                        </p>

                        <div class="post-additional-info inline-items">

                            <a href="#" class="post-add-icon inline-items">
                                <svg class="olymp-heart-icon">
                                    <use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use>
                                </svg>
                                <span>{{post.likes.length}}</span>
                            </a>

                            <ul class="friends-harmonic" v-show="post.likes.length > 0">
                                <li v-for="like in post.likes">
                                    <a href="#">
                                        <img :src="like.user.photo ? '/storage/'+like.user.photo : '/photos/av-default.jpg'" :alt="like.user.name">
                                    </a>
                                </li>
                                <li v-show="post.likes.length > 5">
                                    <a href="#">
                                        <img src="img/friend-harmonic11.jpg" alt="friend">
                                    </a>
                                </li>
                            </ul>


                            <div class="comments-shared">
                                <a :href="'#comment_form_'+post.id"  class="post-add-icon inline-items">
                                    <svg class="olymp-speech-balloon-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use>
                                    </svg>
                                    <span>{{post.comments.length}}</span>
                                </a>
                            </div>


                        </div>



                    </article>

                    <!-- .. end Post -->
                    <ul class="comments-list" v-show="post.comments.length > 0">
                        <li class="comment-item" v-for="comment in post.comments.slice(0, 2)">
                            <div class="post__author author vcard inline-items">
                                <img :src="comment.user.photo ? '/storage/'+comment.user.photo : '/photos/av-default.jpg'" :alt="comment.user.name">

                                <div class="author-date">
                                    <a class="h6 post__author-name fn" href="#">{{comment.user.name}}</a>
                                    <div class="post__date">
                                        <span class=" text-muted" >
                                            {{moment(comment.created_at).local('id').fromNow()}}
                                        </span>
                                    </div>
                                </div>

                                <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>

                            </div>

                            <p>
                                <read-more more-str="Lebih Lanjut" :text="comment.content" link="#" less-str="Lebih Singkat" :max-chars="250"></read-more>
                            </p>

                            <a href="#" class="post-add-icon inline-items">
                                <svg class="olymp-heart-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
                                <span>6</span>
                            </a>
                            <a href="#" class="reply">Reply</a>
                        </li>
                    </ul>
                    <a href="#" class="more-comments" v-show="post.comments.length > 2">View more comments <span>+</span></a>
                    <form class="comment-form inline-items" :id="'comment_form_'+post.id" v-show="commentRow">

                        <div class="post__author author vcard inline-items">
                            <img src="img/author-page.jpg" alt="author">

                            <div class="form-group with-icon-right is-empty">
                                <textarea class="form-control" placeholder=""></textarea>
                                <div class="add-options-message">
                                    <a href="#" class="options-message" data-toggle="modal" data-target="#update-header-photo">
                                        <svg class="olymp-camera-icon">
                                            <use xlink:href="svg-icons/sprites/icons.svg#olymp-camera-icon"></use>
                                        </svg>
                                    </a>
                                </div>
                                <span class="material-input"></span></div>
                        </div>

                        <button class="btn btn-md-2 btn-primary">Post Comment</button>

                        <button class="btn btn-md-2 btn-border-think c-grey btn-transparent custom-color">Cancel</button>

                    </form>
                </div>

                <infinite-loading @infinite="getMore" v-show="infinityShow" spinner="spiral">
                    <span slot="no-more">Tidak Terdapat Data</span>
                </infinite-loading>
                <loading :active.sync="loadingContent"
                         :can-cancel="false"
                         :opacity="0.9"
                         :is-full-page="false"></loading>
            </div>

        </main>

    </div>
</template>

<script>
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';
    import ReadMore from 'vue-read-more';
    import VLazyImage from "v-lazy-image";
    import InfiniteLoading from 'vue-infinite-loading';
    Vue.use(ReadMore);
    export default {
        components: {
            Loading,
            VLazyImage,
            InfiniteLoading
        },
        data(){
            return {
                postUser: [],
                loadingContent: false,
                loadEx: false,
                place: 'home',
                loader: 'dots',
                data_res: null,
                busy: false,
                page: 1,
                infinityShow: false,
                contoh: ['satu', 'dua', 'tiga'],
                commentRow: false,
            }

        },
        created()
        {
            console.log('Aplikasi Dibuka');
            // this.loadingContent = true;
            this.initialize();
        },
        methods: {
            getPage(ref){
                switch (ref) {
                    case 'home':
                        this.place = 'home';
                        break;
                    case 'berita':
                        this.place = 'berita';
                        break;
                    case 'kanal':
                        this.place = 'kanal';
                        break;
                    default : console.log('Tidak Ada Referensi');
                }
            },
            initialize()
            {
                this.loadingContent = true
                axios.get('/get-status?page='+this.page)
                    .then((response)=>{

                        // this.posting.push(response.data.list_post.data);
                        setTimeout(()=>{
                            Array.prototype.push.apply(this.postUser, response.data.list_post.data);

                            this.page = this.page+ 1;
                            this.loadingContent = false;
                            this.infinityShow = true;
                            console.log(this.postUser);
                        }, 200);


                    }).catch(error => {
                        console.log(error.message);
                });
            },
            getMore($state){
                this.page  = this.page +1;
                this.loadingContent = true;
                axios.get('/get-status?page='+this.page)
                    .then((response)=>{
                        this.loadMore($state, response.data);

                    }).catch(error => {
                        console.log(error.message);
                    });
            },
            loadMore($state, response){
                if (response.list_post.data.length > 0) {
                    Array.prototype.push.apply(this.postUser, response.list_post.data);
                    setTimeout(()=>{
                        $state.loaded();
                        this.loadingContent = false;
                    }, 200);

                    if(this.postUser.length === response.list_post.total){
                        $state.complete();
                    }
                } else {
                    $state.complete();
                }
            },
            formatDate(date) {
                var monthNames = [
                    "Januari", "Februari", "Maret",
                    "April", "Mei", "Juni", "Juli",
                    "Agustus", "September", "Oktober",
                    "November", "Desember"
                ];

                var day = date.getDate();
                var monthIndex = date.getMonth();
                var year = date.getFullYear();

                return day + ' ' + monthNames[monthIndex] + ' ' + year;
            },
        }
    }
</script>
