<template>
	<img :src="screen" class="screen">
</template>

<script>
	export default {
		name: "ScreenshotComponent",
		props: ['screen'],
		data(){
			return {

			}
		},
	};
</script>

<style scoped>
	.screen{
		margin: 0px 5px 5px 0px;
		width: 207px;
		height: 115px;
	}

	@media screen and (max-width: 955px){
		.screen{
			width: 192px;
			height: 100px;
		}
	}
</style>