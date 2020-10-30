<template>
    <a :href="torrent.url" rel="nofollow"
       :title="title">
        <p class="torrent">
            <i class="fa fa-download"></i>
            {{torrent.quality}}
            {{torrent.size}}
        </p>
    </a>
</template>

<script>
	export default {
		name: "TorrentComponent",
		props:['torrent', 'movie_title'],
		data(){
			return{
			    title: this.movie_title + ' '
                    + this.torrent.quality + ' torrent',
			}
		},
	};
</script>

<style scoped>
    .torrent_container{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    a{
        text-decoration: none;
        padding-right: 8px;
    }
    .torrent{
        margin: 0;
        padding: 1px 10px 1px 10px;
        border: 1px solid #6ac045;
        background-color: #6ac045;
        border-radius: 3px;
        color: white;
        text-align: center;
        font-weight: bold;
    }
    a:hover .torrent{
        color: black;
    }
</style>
