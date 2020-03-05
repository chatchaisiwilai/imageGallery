<template>
    <div class="col-4 mb-2 hover-image" v-show="isShowComponent">
        <div style="height: 150px">
            <img :src="imageUrl" class="image">
            <div class="position-absolute t40l35">
                <button type="button" class="btn btn-info" v-on:click="pushImageUrlToParent" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-search"></i></button>
                <button type="button" class="btn btn-warning" v-on:click="notShowComponent"><i class="fas fa-trash-restore-alt"></i></button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                isShowComponent: true,
                imageBackground: {
                    textAlign: 'center',
                    lineHeight: '150px',
                },
                imageUrl: ''
            };
        },
        props: [
            'imageDatabase'
        ],
        methods: {
            pushImageUrlToParent() {
                this.$emit('pushImageUrlToParent', this.imageUrl);
            },
            notShowComponent() {
                console.log('destroyed!');
                axios
                    .delete(this.imageUrl)
                    .then(function () {
                        this.isShowComponent = false;
                    }.bind(this))
            },
            notShowComponentError() {
                this.isShowComponent = false;
            }
        },
        created() {
            this.imageUrl = 'gallery/image/' + this.imageDatabase.id;
        }
    }
</script>
<style>
    .t40l35 {
        top: 40%;
        left: 35%;
    }
    .image {
        width: 100%;
        height: auto;
        max-height: 150px;
    }
    .hover-image img{
        opacity: 1;
    }
    .hover-image:hover img{
        opacity: 0.3;
    }
    .hover-image:hover button{
        opacity: 1;
        display: unset;
    }
    .hover-image button{
        opacity: 1;
        display: none;
    }
</style>
