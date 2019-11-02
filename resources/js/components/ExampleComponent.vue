<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" id="a">
                    <div class="card-header">Example Component</div>

                    <div class="card-body s">
                        {{m}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted(){
            console.log(this)
        },
       data(){
            return {
                m:'asd',
            }
       }
    }
</script>
