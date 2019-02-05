<template>
    <div class="row" >
        <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-6 col-12">
            <side-bar v-on:getData="getPage($event)" ></side-bar>
            <div class="ui-block">
                <div class="ui-block-title">
                    <h6 class="title">James’s Badges</h6>
                </div>
                <div class="ui-block-content">

                    <!-- W-Badges -->

                    <ul class="widget w-badges">
                        <li>
                            <a href="24-CommunityBadges.html">
                                <img src="img/badge1.png" alt="author">
                                <div class="label-avatar bg-primary">2</div>
                            </a>
                        </li>
                        <li>
                            <a href="24-CommunityBadges.html">
                                <img src="img/badge4.png" alt="author">
                            </a>
                        </li>
                        <li>
                            <a href="24-CommunityBadges.html">
                                <img src="img/badge3.png" alt="author">
                                <div class="label-avatar bg-blue">4</div>
                            </a>
                        </li>
                        <li>
                            <a href="24-CommunityBadges.html">
                                <img src="img/badge6.png" alt="author">
                            </a>
                        </li>
                        <li>
                            <a href="24-CommunityBadges.html">
                                <img src="img/badge11.png" alt="author">
                            </a>
                        </li>
                        <li>
                            <a href="24-CommunityBadges.html">
                                <img src="img/badge8.png" alt="author">
                            </a>
                        </li>
                        <li>
                            <a href="24-CommunityBadges.html">
                                <img src="img/badge10.png" alt="author">
                            </a>
                        </li>
                        <li>
                            <a href="24-CommunityBadges.html">
                                <img src="img/badge13.png" alt="author">
                                <div class="label-avatar bg-breez">2</div>
                            </a>
                        </li>
                        <li>
                            <a href="24-CommunityBadges.html">
                                <img src="img/badge7.png" alt="author">
                            </a>
                        </li>
                        <li>
                            <a href="24-CommunityBadges.html">
                                <img src="img/badge12.png" alt="author">
                            </a>
                        </li>
                    </ul>

                    <!--.. end W-Badges -->
                </div>
            </div>
        </aside>
        <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
            <loading :active.sync="loadingContent"
                     :can-cancel="false"
                     :loader="loader"
                     :opacity="1.0"
                     :is-full-page="true"></loading>
            <div id="newsfeed-items-grid">

                <div v-for="(post, $index) in posting" :key="$index">
                    <h4>{{post.content}}</h4>
                </div>



            </div>
            <div v-infinite-scroll="initialize" infinite-scroll-disabled="busy" infinite-scroll-distance="10">
                ...
            </div>

        </main>
        <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">

            <div class="ui-block">
                <!-- W-Birthsday-Alert -->

                <div class="widget w-birthday-alert">
                    <div class="icons-block">
                        <svg class="olymp-cupcake-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-cupcake-icon"></use></svg>
                        <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                    </div>

                    <div class="content">
                        <div class="author-thumb">
                            <img src="img/avatar48-sm.jpg" alt="author">
                        </div>
                        <span>Today is</span>
                        <a href="#" class="h4 title">Marina Valentine’s Birthday!</a>
                        <p>Leave her a message with your best wishes on her profile page!</p>
                    </div>
                </div>

                <!-- ... end W-Birthsday-Alert -->			</div>

            <div class="ui-block">
                <div class="ui-block-title">
                    <h6 class="title">Friend Suggestions</h6>
                    <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                </div>



                <!-- W-Action -->

                <ul class="widget w-friend-pages-added notification-list friend-requests">
                    <li class="inline-items">
                        <div class="author-thumb">
                            <img src="img/avatar38-sm.jpg" alt="author">
                        </div>
                        <div class="notification-event">
                            <a href="#" class="h6 notification-friend">Francine Smith</a>
                            <span class="chat-message-item">8 Friends in Common</span>
                        </div>
                        <span class="notification-icon">
							<a href="#" class="accept-request">
								<span class="icon-add without-text">
									<svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
								</span>
							</a>
						</span>
                    </li>

                    <li class="inline-items">
                        <div class="author-thumb">
                            <img src="img/avatar39-sm.jpg" alt="author">
                        </div>
                        <div class="notification-event">
                            <a href="#" class="h6 notification-friend">Hugh Wilson</a>
                            <span class="chat-message-item">6 Friends in Common</span>
                        </div>
                        <span class="notification-icon">
							<a href="#" class="accept-request">
								<span class="icon-add without-text">
									<svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
								</span>
							</a>
						</span>
                    </li>

                    <li class="inline-items">
                        <div class="author-thumb">
                            <img src="img/avatar40-sm.jpg" alt="author">
                        </div>
                        <div class="notification-event">
                            <a href="#" class="h6 notification-friend">Karen Masters</a>
                            <span class="chat-message-item">6 Friends in Common</span>
                        </div>
                        <span class="notification-icon">
							<a href="#" class="accept-request">
								<span class="icon-add without-text">
									<svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
								</span>
							</a>
						</span>
                    </li>

                </ul>

                <!-- ... end W-Action -->
            </div>




            <div class="ui-block">


                <!-- W-Action -->

                <div class="widget w-action">

                    <img src="img/logo.png" alt="Olympus">
                    <div class="content">
                        <h4 class="title">KLIPAA.com</h4>
                        <span>THE BEST SOCIAL NETWORK THEME IS HERE!</span>
                        <a href="01-LandingPage.html" class="btn btn-bg-secondary btn-md">Register Now!</a>
                    </div>
                </div>

                <!-- ... end W-Action -->
            </div>

        </aside>
    </div>
</template>

<script>
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';
    import VLazyImage from "v-lazy-image";
    import infiniteScroll from 'vue-infinite-scroll';
    import InfiniteLoading from 'vue-infinite-loading';
    // Vue.use(InfiniteLoading);

    export default {
        components: {
            Loading,
            VLazyImage,
            InfiniteLoading
        },
        data(){
            return {
                posting: [],
                loadingContent: false,
                place: 'home',
                loader: 'dots',
                data_res: null,
                busy: false,
                page: 1,
                singlepost: ''
            }

        },
        computed: {
            initialPost(){
                return this.posting;
            }
        },
        mounted()
        {
            this.loadingContent = true;
            this.initialize();
        },
        methods: {
            getPage(ref){
                switch (ref) {
                    case 'home':
                        this.place = 'home';
                        console.log('Halaman Home 2');
                        break;
                    case 'berita':
                        this.place = 'berita';
                        console.log('Halaman Berita 2');
                        break;
                    case 'kanal':
                        this.place = 'kanal';
                        console.log('Halaman Kanal 2  ');
                        break;
                    default : console.log('Tidak Ada Referensi');
                }
            },
            initialize()
            {
                axios.get('/get-status?page='+this.page)
                    .then((response)=>{
                        let {list_post} = response.data;
                        if(list_post.data instanceof Array){
                            console.log(list_post.data);
                            Array.prototype.push.apply(this.posting, list_post.data);
                        }

                        this.data_res = list_post;
                        this.page += 1;
                        this.loadingContent = false

                    }).catch(error => {
                    this.loadingContent = false;
                    console.log(JSON.stringify(error));
                });
            },
            getMore(){
                axios.get('/get-status?page='+this.page)
                    .then((response)=>{
                        if (response.data.data.length ) {
                            this.page += 1;
                            let {list_post} = response.data;
                            if(list_post.data instanceof Array){
                                console.log(list_post.data);
                                Array.prototype.push.apply(this.posting, list_post.data);
                            }
                            $state.loaded();
                        } else {
                            $state.complete();
                        }
                        // let {list_post} = response.data;
                        // if(list_post.data instanceof Array){
                        //     console.log(list_post.data);
                        //     Array.prototype.push.apply(this.posting, list_post.data);
                        // }
                        //
                        // this.data_res = list_post;
                        // this.page++;
                        // setTimeout(() => {
                        //
                        //     console.log(JSON.stringify(this.posting));
                        //     this.loadingContent = false
                        // },5000)

                    }).catch(error => {
                    this.loadingContent = false;
                    console.log(JSON.stringify(error));
                });
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
