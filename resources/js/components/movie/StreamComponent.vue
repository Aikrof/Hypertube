<template>
    <div class="col-md-12" v-if="video_full_hd && video_hd">
        <VuePlyr>
            <video @click="handleErr">
                <source v-if="video_hd" :src="hd" type="video/mp4" size="720" default>
                <source v-if="video_full_hd" :src="full_hd" type="video/mp4" size="1080">
            </video>
        </VuePlyr>
        <div style="height: 300px;"></div>
    </div>
</template>

<script>
    "use strict"
    import VuePlyr from 'vue-plyr'

    let torrentStreamUrl= location.protocol + '//' +
        location.host + ':3000/api/v1/torrent-stream/';

    export default {
        name: "StreamComponent",
        components: {VuePlyr},
        props: {
            torrent:{
                require: true,
                type: Array,
            },
            poster:{
                require: true,
                type: String,
            }
        },
        data(){
            return{
                hd: "",
                full_hd: "",
            }
        },
        methods:{
            handleErr: function(){
              console.log('hendleErr')
            },
            getMagnet: function(quality){
                for (let val of this.torrent){
                    if (val.quality === quality){
                        return (val.magnetLink);
                    }
                }
                return (null);
            }
        },
        computed:{
            video_hd(){
                let magnet;
                if (this.torrent !== undefined && (magnet = this.getMagnet('720p'))){
                    this.hd = torrentStreamUrl + magnet;
                    return (true);
                }
                return (false);
            },
            video_full_hd(){
                let magnet;
                if (this.torrent !== undefined && (magnet = this.getMagnet('1080p'))){
                    this.full_hd = torrentStreamUrl + magnet;
                    return (true);
                }
                return (false);
            }
        },
        mounted: function() {
            console.log(this)
        //     this.$refs.videoRef.src = "/t.mp4";
        //     this.$refs.videoRef.play();
        }
    }

    let playPromise = document.querySelector('video');
    console.log(playPromise);
    // if (playPromise !== undefined) {
    //     playPromise.catch(error =>{
    //         console.log(error);
    //     });
    // }
</script>

<style scoped>

</style>

